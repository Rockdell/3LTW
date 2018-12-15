PRAGMA foreign_keys = ON;
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

CREATE TRIGGER deleteUnusedComment
AFTER DELETE ON PostComment
BEGIN
    DELETE FROM Comment WHERE commentID = old.commentID;
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

-- Rockdell:vidal
INSERT INTO User VALUES ('Rockdell', 'Pedro Pinho', '7c8045a66fcb89d3099f8faff3e8058d788982a2d3cb88db73b3aada9f32fd8c', 'xavi@gmail.com', 'This is bio');
-- kick0ut:ltwftw
INSERT INTO User VALUES ('kick0ut', 'Miguel Teixeira', '657eaa9e4fc3cccb0cb352eba782f0ae6d7ea8c73688a44421c95c9c9533582e', 'miguel@gmail.com', 'Je suis très jolie');

INSERT INTO Post VALUES (1, 'Rockdell', 'First Post!', 'Hello there, glad to be your first post! :D', strftime('%s', 'now'), 420);
INSERT INTO Post VALUES (2, 'kick0ut', 'Second Post!', 'Oh Hi Mark, glad to be your second post! xD', '1517355738', 1);
INSERT INTO Post VALUES (3, 'Rockdell', 'Third Post!', 'IDK This is supposed to be a realllllllllllllllllllllllllllllllllllllly big post ahahahahahahahahhahahahahahahhahahahahahahahha', '912469338', 999);

INSERT INTO Comment VALUES (1, 'kick0ut', "This is a comment!", '1515351638', 3);
INSERT INTO Comment VALUES (2, 'Rockdell', "Oh another one!", '1517355710', 100);
INSERT INTO Comment VALUES (3, 'Rockdell', "Okie", '1517311738', 384);
INSERT INTO Comment VALUES (4, 'kick0ut', "t1!", '1515351638', 123);
INSERT INTO Comment VALUES (5, 'Rockdell', "t2!", '1517355710', 1200);
INSERT INTO Comment VALUES (6, 'Rockdell', "t3!", '1517311738', 84);

INSERT INTO PostComment VALUES (1,1);
INSERT INTO PostComment VALUES (1,2);
INSERT INTO PostComment VALUES (1,4);
INSERT INTO PostComment VALUES (1,5);

INSERT INTO PostComment VALUES (2,3);
INSERT INTO PostComment VALUES (2,6);

INSERT INTO ChildComment VALUES (2,4);
INSERT INTO ChildComment VALUES (4,5);