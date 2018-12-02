PRAGMA foreign_keys = ON;
.mode columns
.headers on
.nullvalue NULL

CREATE TABLE User (
    userID VARCHAR PRIMARY KEY,
    username VARCHAR NOT NULL,
    pass VARCHAR NOT NULL,
    mail VARCHAR NOT NULL UNIQUE,
    bio VARCHAR,
    birthday DATE
);

CREATE TABLE Post (
    postID INTEGER PRIMARY KEY AUTOINCREMENT,
    userID VARCHAR REFERENCES User ON DELETE CASCADE,
    title VARCHAR NOT NULL,
    content VARCHAR NOT NULL,
    postDate DATE NOT NULL DEFAULT (datetime('now', 'localtime')),
    points INTEGER DEFAULT 0
);

CREATE TABLE Comment (
    commentID INTEGER PRIMARY KEY AUTOINCREMENT,
    userID VARCHAR REFERENCES User ON DELETE CASCADE,
    content VARCHAR NOT NULL,
    commentDate DATE NOT NULL DEFAULT (datetime('now', 'localtime')),
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

-- Rockdell:vidal
INSERT INTO User VALUES ('Rockdell', 'Pedro Pinho', '7C8045A66FCB89D3099F8FAFF3E8058D788982A2D3CB88DB73B3AADA9F32FD8C', 'xavi@gmail.com', 'This is bio', NULL);

-- kick0ut:ltwftw
INSERT INTO User VALUES ('kick0ut', 'Miguel Teixeira', '657EAA9E4FC3CCCB0CB352EBA782F0AE6D7EA8C73688A44421C95C9C9533582E', 'miguel@gmail.com', 'Je suis très jolie', NULL);


INSERT INTO Post VALUES (1, 'Rockdell', 'First Post!', 'Hello there, glad to be your first post! :D', datetime('now', 'localtime'), 420);
INSERT INTO Post VALUES (2, 'kick0ut', 'Second Post!', 'Oh Hi Mark, glad to be your second post! xD', '2018-01-30 23:42:18', 1);
INSERT INTO Post VALUES (3, 'Rockdell', 'Third Post!', 'IDK This is supposed to be a realllllllllllllllllllllllllllllllllllllly big post ahahahahahahahahhahahahahahahhahahahahahahahha', '1998-11-30 23:42:18', 999);

INSERT INTO Comment VALUES (1, 'kick0ut', "This is a comment!", '2018-12-10 23:42:18', 3);
INSERT INTO Comment VALUES (2, 'Rockdell', "Oh another one!", '2018-12-10 23:42:17', 100);
INSERT INTO Comment VALUES (3, 'Rockdell', "Okie", '2018-02-10 23:42:18', 384);

INSERT INTO PostComment VALUES (1,1);
INSERT INTO PostComment VALUES (1,2);
INSERT INTO PostComment VALUES (2,3);