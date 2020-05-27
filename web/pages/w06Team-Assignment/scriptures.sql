CREATE TABLE scriptures (
  id SERIAL PRIMARY KEY,
  book VARCHAR(255),
  chapter INT,
  verse INT,
  content TEXT
  
);

INSERT INTO scriptures (book, chapter, verse, content) VALUES ('John', 1, 5, 'And the light shineth in darkness; and the darkness comprehended it not.');
INSERT INTO scriptures (book, chapter, verse, content) VALUES ('Doctrine and Covenants', 88, 49, 'The light shineth in darkness, and the darkness comprehendeth it not; nevertheless, the day shall come when you shall bomprehend even God, being quickened in him and by him.');
INSERT INTO scriptures (book, chapter, verse, content) VALUES ('Doctrine and Covenants', 93, 28, 'He that keepeth his commandments receiveth truth and light, until he is glorified in truth and knoweth all things.');
INSERT INTO scriptures (book, chapter, verse, content) VALUES ('Mosiah', 16, 9, 'He is the light and the life of the world; yea, a light that is endless, that can never be darkened; yea, and also a life which is endless, that there can be no more death.');


SELECT book, content from scriptures ORDER by id DESC;

UPDATE scriptures SET content = 'And the light shineth in darkness; and the darkness comprehended it not.' WHERE id = 1;

CREATE TABLE topics (
  id SERIAL PRIMARY KEY,
  topic VARCHAR(100)

);

CREATE TABLE scripture_topic (
  scripture_id INT NOT NULL REFERENCES scriptures(id),
  topic_id INT NOT NULL REFERENCES topics(id)
);

INSERT INTO topics (topic) VALUES ('Faith'), ('Sacrifice'), ('Charity');

INSERT INTO scripture_topic (scripture_id, topic_id) VALUES (1,1);
INSERT INTO scripture_topic (scripture_id, topic_id) VALUES (1,2);
INSERT INTO scripture_topic (scripture_id, topic_id) VALUES (3,1);
INSERT INTO scripture_topic (scripture_id, topic_id) VALUES (4,2);
INSERT INTO scripture_topic (scripture_id, topic_id) VALUES (6,3);
INSERT INTO scripture_topic (scripture_id, topic_id) VALUES (5,2);
INSERT INTO scripture_topic (scripture_id, topic_id) VALUES (7,2);
INSERT INTO scripture_topic (scripture_id, topic_id) VALUES (8,3);
INSERT INTO scripture_topic (scripture_id, topic_id) VALUES (3,1);
INSERT INTO scripture_topic (scripture_id, topic_id) VALUES (6,1);



SELECT topic FROM topics t 
INNER JOIN scripture_topic st ON st.topic_id = t.id 
WHERE st.scripture_id = 2;



SELECT topic FROM topics AS t
JOIN scripture_topic AS st ON st.scripture_id = t.id
WHERE st.scripture_id = 1;