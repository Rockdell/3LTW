CREATE TABLE User (
    userID VARCHAR PRIMARY KEY,
    username VARCHAR NOT NULL,
    pass VARCHAR NOT NULL,
    mail VARCHAR NOT NULL UNIQUE,
    bio VARCHAR,
    birthday DATE,
    points INTEGER DEFAULT 0
);

CREATE TABLE Post (
    postID INTEGER PRIMARY KEY,
    userID VARCHAR REFERENCES User NOT NULL,
    title VARCHAR NOT NULL,
    content VARCHAR NOT NULL,
    postDate DATE NOT NULL,
    points INTEGER DEFAULT 0
);

CREATE TABLE Comment (
    commentID INTEGER PRIMARY KEY,
    userID VARCHAR REFERENCES User NOT NULL,
    content VARCHAR NOT NULL,
    commentDate DATE NOT NULL,
    points INTEGER DEFAULT 0
);

CREATE TABLE PostUser (
    postID INTEGER REFERENCES Post,
    userID VARCHAR REFERENCES User,
    vote INTEGER CHECK (0 <= vote <= 1),
    PRIMARY KEY (postID, userID)
);

CREATE TABLE PostComment (
    postID INTEGER REFERENCES Post,
    commentID INTEGER REFERENCES Comment UNIQUE,
    PRIMARY KEY (postID, commentID)
);

CREATE TABLE ChildComment (
    commentFather INTEGER REFERENCES Comment,
    commentSon INTEGER REFERENCES Comment,
    PRIMARY KEY (commentFather, commentSon)
);

INSERT INTO User VALUES (1, 'Rockdell', 'youwish', 'test@gmail.com', 'This is bio', NULL, 999);
INSERT INTO Post VALUES (1, 1, 'First Post!', 'Hello there, glad to be your first post! :D', datetime('now', 'localtime'), 420);