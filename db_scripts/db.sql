ALTER TABLE chat_tb DROP CONSTRAINT fkey

ALTER TABLE chat_tb ADD CONSTRAINT fkey FOREIGN KEY(user_id) REFERENCES user_tb(user_id) ON DELETE CASCADE

CREATE TABLE hashtag_tb (
    hashtag_id SERIAL PRIMARY KEY,
    hashtag_name varchar(20)
)

CREATE TABLE tag_tb (
    message_id int not null,
    hashtag_id int not null,
    primary key(message_id, hashtag_id),
    foreign key(message_id) references chat_tb(message_id) ON DELETE CASCADE,
    foreign key(hashtag_id) references hashtag_tb(hashtag_id) ON DELETE CASCADE
)

-- get by hashtag
SELECT *
FROM user_tb, chat_tb, tag_tb, hashtag_tb
WHERE user_tb.user_id = chat_tb.user_id
AND chat_tb.message_id = tag_tb.message_id
AND tag_tb.hashtag_id = hashtag_tb.hashtag_id