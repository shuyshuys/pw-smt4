CREATE TABLE covid_data (
  id INT AUTO_INCREMENT PRIMARY KEY,
  country VARCHAR(255),
  total_cases INT,
  total_deaths INT,
  total_recovered INT,
  active_cases INT,
  total_tests INT,
  population INT
);

INSERT INTO covid_data (country, total_cases, total_deaths, total_recovered, active_cases, total_tests, population)
VALUES
  ('India', 44986461, 531832, 44446514, 8115, 929430169, 1406631776),
  ('Japan', 33803572, 74694, NULL, NULL, 100414883, 125584838),
  ('S. Korea', 31548083, 34687, 31198069, 315327, 15804065, 51329899),
  ('Turkey', 17232066, 102174, NULL, NULL, 162743369, 85561976),
  ('Vietnam', 11602738, 43203, 10635065, 924470, 85826548, 98953541),
  ('Taiwan', 10239998, 19005, 10220993, 0, 30742304, 23888595),
  ('Iran', 7611224, 146236, 7364870, 100118, 56596583, 86022837),
  ('Indonesia', 6802090, 161674, 6625209, 15207, 114158919, 279134505),
  ('Malaysia', 5088009, 37046, 5029873, 21090, 68352292, 33181072),
  ('Israel', 4824551, 12509, 4798473, 13569, 41373364, 9326000);
