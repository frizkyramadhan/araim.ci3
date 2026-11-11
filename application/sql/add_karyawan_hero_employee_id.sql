-- Link an ARAIM karyawan row to an Arka Hero person.
-- Stores employees.id. Does not copy or refresh NIK. Existing rows stay NULL.
ALTER TABLE `karyawan`
  ADD COLUMN `hero_employee_id` varchar(36) DEFAULT NULL;
