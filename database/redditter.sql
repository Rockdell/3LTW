PRAGMA foreign_keys = ON;
PRAGMA recursive_triggers = ON;
.mode columns
.headers on
.nullvalue NULL

CREATE TABLE User (
    userID VARCHAR PRIMARY KEY,
    username VARCHAR NOT NULL,
    pass VARCHAR NOT NULL,
    mail VARCHAR NOT NULL UNIQUE,
    bio VARCHAR
);

CREATE TABLE Post (
    postID INTEGER PRIMARY KEY AUTOINCREMENT,
    userID VARCHAR REFERENCES User ON DELETE CASCADE,
    title VARCHAR NOT NULL,
    content VARCHAR NOT NULL,
    postDate DATE NOT NULL DEFAULT (strftime('%s', 'now')),
    points INTEGER DEFAULT 0
);

CREATE TABLE Comment (
    commentID INTEGER PRIMARY KEY AUTOINCREMENT,
    userID VARCHAR REFERENCES User ON DELETE CASCADE,
    content VARCHAR NOT NULL,
    commentDate DATE NOT NULL DEFAULT (strftime('%s', 'now')),
    points INTEGER DEFAULT 0
);

CREATE TABLE PostVote (
    postID INTEGER REFERENCES Post ON DELETE CASCADE,
    userID VARCHAR REFERENCES User ON DELETE CASCADE,
    vote INTEGER CHECK (0 <= vote <= 1),
    PRIMARY KEY (postID, userID)
);

CREATE TABLE CommentVote (
    commentID INTEGER REFERENCES Comment ON DELETE CASCADE,
    userID VARCHAR REFERENCES User ON DELETE CASCADE,
    vote INTEGER CHECK (0 <= vote <= 1),
    PRIMARY KEY (commentID, userID)
);

CREATE TABLE PostComment (
    postID INTEGER REFERENCES Post ON DELETE CASCADE,
    commentID INTEGER REFERENCES Comment ON DELETE CASCADE,
    PRIMARY KEY (postID, commentID)
);

CREATE TABLE ChildComment (
    commentFather INTEGER REFERENCES Comment ON DELETE CASCADE,
    commentSon INTEGER REFERENCES Comment ON DELETE CASCADE,
    PRIMARY KEY (commentFather, commentSon)
);

CREATE TRIGGER deletePostsComment
AFTER DELETE on Post
BEGIN
    DELETE FROM PostComment WHERE postID = old.postID;
END;

CREATE TRIGGER deleteUnusedComment
AFTER DELETE ON PostComment
FOR EACH ROW
BEGIN
    DELETE FROM Comment WHERE commentID = old.commentID;
END;

CREATE TRIGGER deleteCommentChildren
BEFORE DELETE on Comment
BEGIN
    DELETE FROM Comment WHERE commentID IN (SELECT commentSon FROM ChildComment WHERE commentFather = old.commentID);
END;

-- For easy insertion of votes

CREATE TRIGGER updatePostVote
BEFORE INSERT ON PostVote
WHEN EXISTS(SELECT * FROM PostVote WHERE PostVote.postID = new.postID AND PostVote.userID = new.userID)
BEGIN
    DELETE FROM PostVote WHERE PostVote.postID = new.postID AND PostVote.userID = new.userID;
END;

CREATE TRIGGER updateCommentVote
BEFORE INSERT ON CommentVote
WHEN EXISTS(SELECT * FROM CommentVote WHERE CommentVote.commentID = new.commentID AND CommentVote.userID = new.userID)
BEGIN
    DELETE FROM CommentVote WHERE CommentVote.commentID = new.commentID AND CommentVote.userID = new.userID;
END;


-- Update Post Points on Insert

CREATE TRIGGER updatePostPointsDownInsert
AFTER INSERT ON PostVote
WHEN (new.vote = 0)
BEGIN
    UPDATE Post SET points = points - 1 WHERE Post.postID = new.postID;
END;

CREATE TRIGGER updatePostPointsUpInsert
AFTER INSERT ON PostVote
WHEN (new.vote = 1)
BEGIN
    UPDATE Post SET points = points + 1 WHERE Post.postID = new.postID;
END;


-- Update Post Points on Delete

CREATE TRIGGER updatePostPointsDownDelete
AFTER DELETE ON PostVote
WHEN (old.vote = 0)
BEGIN
    UPDATE Post SET points = points + 1 WHERE Post.postID = old.postID;
END;

CREATE TRIGGER updatePostPointsUpDelete
AFTER DELETE ON PostVote
WHEN (old.vote = 1)
BEGIN
    UPDATE Post SET points = points - 1 WHERE Post.postID = old.postID;
END;


-- Update Comment Points on Insert

CREATE TRIGGER updateCommentPointsDownInsert
AFTER INSERT ON CommentVote
WHEN (new.vote = 0)
BEGIN
    UPDATE Comment SET points = points - 1 WHERE Comment.commentID = new.commentID;
END;

CREATE TRIGGER updateCommentPointsUpInsert
AFTER INSERT ON CommentVote
WHEN (new.vote = 1)
BEGIN
    UPDATE Comment SET points = points + 1 WHERE Comment.commentID = new.commentID;
END;


-- Update Comment Points on Delete

CREATE TRIGGER updateCommentPointsDownDelete
AFTER DELETE ON CommentVote
WHEN (old.vote = 0)
BEGIN
    UPDATE Comment SET points = points + 1 WHERE Comment.commentID = old.commentID;
END;

CREATE TRIGGER updateCommentPointsUpDelete
AFTER DELETE ON CommentVote
WHEN (old.vote = 1)
BEGIN
    UPDATE Comment SET points = points - 1 WHERE Comment.commentID = old.commentID;
END;