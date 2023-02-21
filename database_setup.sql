CREATE TABLE app_user
( id int PRIMARY KEY,
  first_name varchar(225) NOT NULL,
  last_name varchar(225),
  username varchar(225) NOT NULL,
  password varchar(225) NOT NULL,
  created_at TIMESTAMP NOT NULL,
  deleted_at TIMESTAMP
);

CREATE TABLE event
( id int PRIMARY KEY,
  title varchar(225),
  exercise_type varchar(225),
  exercise_subtype varchar(225),
  description varchar,
  created_at TIMESTAMP NOT NULL,
  deleted_at TIMESTAMP
);

CREATE TABLE user_event
( id int PRIMARY KEY,
  user_id int,
  exercise_id int,
  created_at TIMESTAMP NOT NULL,
  exercise_date TIMESTAMP NOT NULL,
  deleted_at TIMESTAMP,
  CONSTRAINT event_for_user
      FOREIGN KEY(user_id)
          REFERENCES app_user(id),
  CONSTRAINT event
      FOREIGN KEY(exercise_id)
          REFERENCES event(id),
  weight int,
  reps int,
  duration int,
  completed bool
);