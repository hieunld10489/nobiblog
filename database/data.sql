truncate table vocabulary_category;
INSERT INTO vocabulary_category (`name`, `show`, `created`, `modified`) VALUES
('it','it', now(), now())
,('sport','sport', now(), now());

truncate table vocabulary_type;
INSERT INTO vocabulary_type (`vocabulary_category_id`,`name`, `show`, `created`, `modified`) VALUES
(1, 'Lập trình','Lập trình', now(), now())
,(1, 'Dữ liệu','Dữ liệu', now(), now())
,(1, 'Giao diện','Giao diện', now(), now())
,(1, 'Nút xử lý','Nút xử lý', now(), now())
,(1, 'Thiết bị & Phần cứng','Thiết bị & Phần cứng', now(), now())
,(1, 'Tài liệu thiết kế','Tài liệu thiết kế', now(), now())
,(1, 'Thao tác','Thao tác', now(), now())
,(1, 'Network','Network', now(), now())
,(1, 'Security','Security', now(), now())
,(1, 'Ứng dụng','Ứng dụng', now(), now())
,(1, 'Soạn thảo','Soạn thảo', now(), now())
,(1, 'Tên riêng','Tên riêng', now(), now())
,(1, 'Khác','Khác', now(), now());

truncate table vocabulary_synonym;
INSERT INTO vocabulary_synonym (`vocabulary_id`,`synonym_id`,`created`,`modified`) VALUES
(45, 46, now(), now())
,(45, 47, now(), now())
,(46, 45, now(), now())
,(46, 47, now(), now())
,(47, 45, now(), now())
,(47, 46, now(), now());

truncate table statistic_access;
INSERT INTO statistic_access (`id`,`key`,`value`,current,created,modified) VALUES
(1, 'today', 0, now(),now(),now()),
(2, 'yesterday', 0, now(),now(),now());

