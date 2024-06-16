/*
 Navicat Premium Data Transfer

 Source Server         : Sql Brew
 Source Server Type    : MySQL
 Source Server Version : 80300 (8.3.0)
 Source Host           : localhost:3306
 Source Schema         : inventory_management_system

 Target Server Type    : MySQL
 Target Server Version : 80300 (8.3.0)
 File Encoding         : 65001

 Date: 16/06/2024 14:50:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for agens
-- ----------------------------
DROP TABLE IF EXISTS `agens`;
CREATE TABLE `agens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `account_holder` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `agens_email_unique`(`email` ASC) USING BTREE,
  UNIQUE INDEX `agens_phone_unique`(`phone` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of agens
-- ----------------------------
BEGIN;
INSERT INTO `agens` (`id`, `name`, `email`, `phone`, `address`, `photo`, `account_holder`, `account_number`, `bank_name`, `created_at`, `updated_at`) VALUES (1, 'rctbbO0vaC', 'admin@app.com', '7391367759', '0KhGXB4Kyi', '1779387221860437.jpg', 'OX4kt2n9Qk', '1874538084', 'BRI', '2023-10-10 16:38:12', '2023-10-10 16:38:12'), (2, 'winter', 'admin@web.com', '8732183731278', 'alamat', NULL, 'OX4kt2n9Qk', '1111774915', 'BNI', '2023-12-07 14:34:21', '2023-12-07 14:34:21');
COMMIT;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_id` bigint UNSIGNED NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `categories_name_unique`(`name` ASC) USING BTREE,
  UNIQUE INDEX `categories_slug_unique`(`slug` ASC) USING BTREE,
  INDEX `categories_status_id_foreign`(`status_id` ASC) USING BTREE,
  CONSTRAINT `categories_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `master_status` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of categories
-- ----------------------------
BEGIN;
INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`, `status_id`) VALUES (1, 'categori 1', 'categori-1', '2023-09-12 02:20:48', '2023-09-12 02:20:48', 1);
COMMIT;

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nik` int NULL DEFAULT NULL,
  `npwp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `account_holder` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_id` bigint UNSIGNED NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `customers_email_unique`(`email` ASC) USING BTREE,
  UNIQUE INDEX `customers_phone_unique`(`phone` ASC) USING BTREE,
  INDEX `customers_status_id_foreign`(`status_id` ASC) USING BTREE,
  CONSTRAINT `customers_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `master_status` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of customers
-- ----------------------------
BEGIN;
INSERT INTO `customers` (`id`, `name`, `nik`, `npwp`, `email`, `phone`, `address`, `photo`, `account_holder`, `account_number`, `bank_name`, `created_at`, `updated_at`, `status_id`) VALUES (1, 'customer', 129301293, '921039110', 'cek@mail.com', '20923093', 'dasd', NULL, 'dasidji', '932093', 'BNI', '2023-09-12 07:54:45', '2023-10-24 11:44:05', 1), (2, 'Agen', NULL, NULL, 'agen@mail.com', '08528392812', 'Agen', '1779386931698407.png', 'Agen', '213989', 'BRI', '2023-10-10 16:33:35', '2023-10-10 16:33:35', 1), (3, 'ROqp9aiYMc', 7647676, '675675657', '5aaNv4KSGQ@mail.com', '3037673148', 'xgluAX0AQ5', NULL, 'xdbEPAqcNG', '1538705787', NULL, '2023-12-17 08:36:46', '2023-12-17 08:36:46', 1), (4, 'ROqp9aiYMc', 7647676, '675675657', '5aaNv4KSGQgbh@mail.com', '3037673148897', 'xgluAX0AQ5', NULL, 'xdbEPAqcNG', '1538705787', NULL, '2023-12-17 08:37:40', '2023-12-17 08:37:40', 1), (5, 'cz5i8ZvEid', 7647676, '675675657', '5aaNv4KSGdasdQ@mail.com', '9646737534324324', 'APfpA0B8Cs', NULL, '8A32NW0kEr', '4869456376', NULL, '2023-12-17 08:39:30', '2023-12-17 08:39:30', 1), (6, 'ZZEzmotPeb', 96332, '2787128217', 'nUsv7ZKi6l@mail.com', '6883213257', 'yMwB0WiUBQ', NULL, 'mZDhIm6diE', '0367573384', 'BNI', '2024-01-16 01:54:16', '2024-01-16 01:54:16', 1), (10, 'jufi2rNv7k', 926434, '124878', 'qcybb@dhsf.com', '8915565370', 'qIjYyKo4my', NULL, 'wCbhcgpMMW', '4915619374', NULL, '2024-02-03 18:26:13', '2024-02-03 18:26:13', 1), (11, 'vVwgk12v2T', 423436, '501805', 'h6p54@bqq4.com', '4373550965', 'CaLBZZ2pYJ', NULL, 'ShCBbUsKYs', '8878456441', NULL, '2024-02-03 18:26:50', '2024-02-03 18:26:50', 1), (12, 'rsnUZBqBeI', 297993, '114576', '6eunm@2dth.com', '7246006072', 'zhix3JeH3Z', NULL, '6zAFV5V6el', '6073923168', NULL, '2024-02-03 18:27:28', '2024-02-03 18:27:28', 1);
COMMIT;

-- ----------------------------
-- Table structure for delivery_order_purchases
-- ----------------------------
DROP TABLE IF EXISTS `delivery_order_purchases`;
CREATE TABLE `delivery_order_purchases`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `purchase_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `supplier_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_delivery_supplier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `no_invoice_supplier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `no_faktur_pajak_supplier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `invoice_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `delivery_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of delivery_order_purchases
-- ----------------------------
BEGIN;
INSERT INTO `delivery_order_purchases` (`id`, `purchase_id`, `supplier_id`, `no_delivery_supplier`, `no_invoice_supplier`, `no_faktur_pajak_supplier`, `invoice_description`, `delivery_date`, `created_at`, `updated_at`) VALUES (5, '18', '2', '742125', '601982', '750147', 'kSE8wVc4nn', '2024-04-14', '2024-04-14 06:01:02', '2024-04-14 06:01:02');
COMMIT;

-- ----------------------------
-- Table structure for delivery_orders
-- ----------------------------
DROP TABLE IF EXISTS `delivery_orders`;
CREATE TABLE `delivery_orders`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_customer` bigint UNSIGNED NOT NULL,
  `id_order` bigint UNSIGNED NOT NULL,
  `invoice_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `delivery_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ship_via` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `delivery_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of delivery_orders
-- ----------------------------
BEGIN;
INSERT INTO `delivery_orders` (`id`, `id_customer`, `id_order`, `invoice_description`, `delivery_number`, `ship_via`, `delivery_date`, `created_at`, `updated_at`) VALUES (13, 1, 23, 'Penjualan tgl 18052024', 'DLV-28355', '-', '2024-05-18', '2024-05-18 14:29:49', '2024-05-18 14:29:49'), (14, 1, 23, 'Penjualan tgl 18052024', 'DLV-03042', '-', '2024-05-18', '2024-05-18 14:29:50', '2024-05-18 14:29:50');
COMMIT;

-- ----------------------------
-- Table structure for detail_master_values
-- ----------------------------
DROP TABLE IF EXISTS `detail_master_values`;
CREATE TABLE `detail_master_values`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `master_value_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `detail_master_values_master_value_id_foreign`(`master_value_id` ASC) USING BTREE,
  CONSTRAINT `detail_master_values_master_value_id_foreign` FOREIGN KEY (`master_value_id`) REFERENCES `master_values` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 133 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of detail_master_values
-- ----------------------------
BEGIN;
INSERT INTO `detail_master_values` (`id`, `master_value_id`, `name`, `description`, `created_at`, `updated_at`) VALUES (106, 1, 'Gulaku', 'Gulaku adalah merk gula ini itu', '2023-10-04 07:41:44', '2024-01-03 23:52:26'), (107, 2, 'Barang Jadi', 'Barang Jadi', '2023-10-04 07:41:58', '2023-10-04 07:41:58'), (108, 3, 'Minuman', 'Minuman', '2023-10-04 07:42:11', '2023-10-04 07:42:11'), (109, 4, 'Minuman', 'Minuman', '2023-10-04 07:42:21', '2023-10-04 07:42:21'), (110, 5, 'Minuman Mineral', 'Minuman Mineral', '2023-10-04 07:42:36', '2023-10-04 07:42:36'), (111, 6, 'Indonesia', 'Indonesia', '2023-10-04 07:42:46', '2023-10-04 07:42:46');
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for identity_files
-- ----------------------------
DROP TABLE IF EXISTS `identity_files`;
CREATE TABLE `identity_files`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_identity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `identity_files_customer_id_foreign`(`customer_id` ASC) USING BTREE,
  CONSTRAINT `identity_files_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of identity_files
-- ----------------------------
BEGIN;
INSERT INTO `identity_files` (`id`, `customer_id`, `title`, `image_identity`, `created_at`, `updated_at`) VALUES (3, 5, '2f74Sz17EG', '1785520707747912.png', '2023-12-17 09:27:20', '2023-12-17 09:27:20');
COMMIT;

-- ----------------------------
-- Table structure for item_products
-- ----------------------------
DROP TABLE IF EXISTS `item_products`;
CREATE TABLE `item_products`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `unit_id` bigint UNSIGNED NOT NULL,
  `detail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `production_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `item_products_unit_id_foreign`(`unit_id` ASC) USING BTREE,
  INDEX `item_products_production_id_foreign`(`production_id` ASC) USING BTREE,
  INDEX `product_id`(`product_id` ASC) USING BTREE,
  CONSTRAINT `item_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `item_products_production_id_foreign` FOREIGN KEY (`production_id`) REFERENCES `productions` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `item_products_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of item_products
-- ----------------------------
BEGIN;
INSERT INTO `item_products` (`id`, `item_code`, `quantity`, `unit_id`, `detail`, `product_id`, `production_id`, `created_at`, `updated_at`) VALUES (23, 'XVMBFdLnha', 3000, 1, NULL, 21, 38, '2024-03-29 13:30:50', '2024-03-29 13:30:50'), (24, 'Santana A', 5, 1, NULL, 20, 39, '2024-05-18 14:26:03', '2024-05-18 14:26:03'), (25, 'SN B', 4, 1, '-', 23, 39, '2024-05-18 14:26:03', '2024-05-18 14:26:03'), (26, 'Santana A', 5, 1, NULL, 20, 40, '2024-05-18 14:44:36', '2024-05-18 14:44:36'), (27, 'Santana A', 5, 1, NULL, 20, 41, '2024-05-18 14:45:44', '2024-05-18 14:45:44');
COMMIT;

-- ----------------------------
-- Table structure for master_status
-- ----------------------------
DROP TABLE IF EXISTS `master_status`;
CREATE TABLE `master_status`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of master_status
-- ----------------------------
BEGIN;
INSERT INTO `master_status` (`id`, `name`, `created_at`, `updated_at`) VALUES (1, 'aktif', NULL, NULL), (2, 'tidak aktif', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for master_values
-- ----------------------------
DROP TABLE IF EXISTS `master_values`;
CREATE TABLE `master_values`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_id` bigint UNSIGNED NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 51 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of master_values
-- ----------------------------
BEGIN;
INSERT INTO `master_values` (`id`, `name`, `description`, `created_at`, `updated_at`, `status_id`) VALUES (1, 'Merek', 'Merek / Brand', '2023-10-02 08:10:54', '2023-10-02 08:10:54', 1), (2, 'Grade', 'Grade (Bahan Jadi dsb)', '2023-10-02 08:23:32', '2023-10-02 08:23:32', 1), (3, 'Group', 'Group', '2023-10-02 08:35:56', '2023-10-02 08:35:56', 1), (4, 'Tipe', 'Tipe', '2023-10-03 15:38:01', '2023-10-03 15:38:01', 1), (5, 'Item Tipe', 'Tipe', '2023-10-03 15:38:50', '2023-10-03 15:38:50', 1), (6, 'Made In', 'Made In', '2023-10-03 15:39:46', '2023-10-03 15:39:46', 1);
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '2014_10_12_000000_create_users_table', 1), (2, '2014_10_12_100000_create_password_reset_tokens_table', 1), (3, '2019_08_19_000000_create_failed_jobs_table', 1), (4, '2019_12_14_000001_create_personal_access_tokens_table', 1), (5, '2023_04_30_072200_add_username_and_phoro_to_users_table', 1), (6, '2023_04_30_150318_create_customers_table', 1), (7, '2023_05_01_111143_create_suppliers_table', 1), (8, '2023_05_02_114617_create_categories_table', 1), (9, '2023_05_02_122454_create_units_table', 1), (10, '2023_05_02_140630_create_products_table', 1), (11, '2023_05_04_084431_create_orders_table', 1), (12, '2023_05_04_084646_create_order_details_table', 1), (13, '2023_05_04_173440_create_shoppingcart_table', 1), (14, '2023_05_06_142348_create_purchases_table', 1), (15, '2023_05_06_143104_create_purchase_details_table', 1), (16, '2023_09_10_035201_create_permission_tables', 1), (17, '2023_09_15_172237_create_master_values_table', 2), (18, '2023_09_15_172301_create_detail_master_values_table', 2), (19, '2023_09_15_172425_create_master_status_table', 3), (20, '2023_09_15_172854_add_status_id_to_all_tables', 4), (21, '2023_10_09_152728_create_agens_table', 5), (22, '2023_10_08_005455_create_productions_table', 6), (23, '2023_10_08_005532_create_item_products_table', 6), (24, '2023_11_27_030219_create_delivery_orders_table', 7), (25, '2023_12_16_031824_create_identity_files_table', 8), (26, '2024_04_14_061204_create_settings_general_table', 9);
COMMIT;

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------
BEGIN;
INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES (1, 'App\\Models\\Role', 2);
COMMIT;

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
BEGIN;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES (1, 'App\\Models\\User', 1), (3, 'App\\Models\\User', 2);
COMMIT;

-- ----------------------------
-- Table structure for order_details
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_fee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_discount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `fee` int NOT NULL,
  `discount` int NOT NULL,
  `unitcost` int NOT NULL,
  `total` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of order_details
-- ----------------------------
BEGIN;
INSERT INTO `order_details` (`id`, `order_id`, `type_fee`, `type_discount`, `product_id`, `quantity`, `fee`, `discount`, `unitcost`, `total`, `created_at`, `updated_at`) VALUES (30, '23', 'amount', 'amount', '20', 1, 0, 0, 100000, 100000, '2024-05-09 10:43:54', NULL);
COMMIT;

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `agen_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_products` int NOT NULL,
  `sub_total` int NOT NULL,
  `totalDiscount` int NOT NULL,
  `totalFee` int NOT NULL,
  `vat` int NOT NULL,
  `total` int NOT NULL,
  `invoice_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay` int NOT NULL,
  `due` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_id` bigint UNSIGNED NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `orders_status_id_foreign`(`status_id` ASC) USING BTREE,
  CONSTRAINT `orders_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `master_status` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of orders
-- ----------------------------
BEGIN;
INSERT INTO `orders` (`id`, `agen_id`, `customer_id`, `due_date`, `order_date`, `order_status`, `total_products`, `sub_total`, `totalDiscount`, `totalFee`, `vat`, `total`, `invoice_no`, `payment_type`, `pay`, `due`, `created_at`, `updated_at`, `status_id`) VALUES (23, '2', '1', '2024-05-09 10:43:50', '2024-05-09', 'complete', 1, 100000, 0, 0, 11000, 111000, 'INV-000001', 'DUE', 111000, 0, '2024-05-09 10:43:53', '2024-05-18 14:28:57', 1);
COMMIT;

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
BEGIN;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES (1, 'list', 'web', '2023-09-10 14:26:55', '2023-09-10 14:26:55'), (2, 'create', 'web', '2023-09-10 14:26:55', '2023-09-10 14:26:55'), (3, 'edit', 'web', '2023-09-10 14:26:55', '2023-09-10 14:26:55'), (4, 'delete', 'web', '2023-09-10 14:26:55', '2023-09-10 14:26:55');
COMMIT;

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for productions
-- ----------------------------
DROP TABLE IF EXISTS `productions`;
CREATE TABLE `productions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `stock_production` int NOT NULL DEFAULT 1,
  `detail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` bigint UNSIGNED NOT NULL,
  `unit_id` bigint UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_production` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `productions_unit_id_foreign`(`unit_id` ASC) USING BTREE,
  INDEX `name`(`name` ASC) USING BTREE,
  CONSTRAINT `productions_ibfk_1` FOREIGN KEY (`name`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `productions_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of productions
-- ----------------------------
BEGIN;
INSERT INTO `productions` (`id`, `stock_production`, `detail`, `name`, `unit_id`, `start_date`, `end_date`, `created_at`, `updated_at`, `status_production`) VALUES (38, 1, NULL, 20, 1, '2024-03-29', NULL, '2024-03-29 13:30:50', '2024-03-29 13:30:50', '0'), (39, 1, '-', 24, 1, '2024-05-18', NULL, '2024-05-18 14:26:03', '2024-05-18 14:26:03', '0'), (40, 1, '-', 24, 1, '2024-05-18', NULL, '2024-05-18 14:44:36', '2024-05-18 14:44:36', '1'), (41, 1, '-', 24, 1, '2024-05-18', NULL, '2024-05-18 14:45:44', '2024-05-18 14:45:44', '1');
COMMIT;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `unit_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `weightKg` int NOT NULL DEFAULT 0,
  `weight` int NOT NULL DEFAULT 0,
  `min_stock` int NOT NULL DEFAULT 1,
  `discount_percent` int NULL DEFAULT 0,
  `discount_price` int NULL DEFAULT 0,
  `bag` int NOT NULL DEFAULT 0,
  `stock` int NOT NULL DEFAULT 0,
  `buying_price` int NULL DEFAULT NULL,
  `selling_price` int NULL DEFAULT NULL,
  `product_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `supplier_id` bigint UNSIGNED NULL DEFAULT NULL,
  `status_id` bigint UNSIGNED NULL DEFAULT 1,
  `brand_id` bigint UNSIGNED NULL DEFAULT NULL,
  `grade_id` bigint UNSIGNED NULL DEFAULT NULL,
  `group_id` bigint UNSIGNED NULL DEFAULT NULL,
  `type_id` bigint UNSIGNED NULL DEFAULT NULL,
  `item_type_id` bigint UNSIGNED NULL DEFAULT NULL,
  `made_in_id` bigint UNSIGNED NULL DEFAULT NULL,
  `product_base_bag` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `products_status_id_foreign`(`status_id` ASC) USING BTREE,
  INDEX `products_brand_id_foreign`(`brand_id` ASC) USING BTREE,
  INDEX `products_grade_id_foreign`(`grade_id` ASC) USING BTREE,
  INDEX `products_group_id_foreign`(`group_id` ASC) USING BTREE,
  INDEX `products_type_id_foreign`(`type_id` ASC) USING BTREE,
  INDEX `products_item_type_id_foreign`(`item_type_id` ASC) USING BTREE,
  INDEX `made_in_id`(`made_in_id` ASC) USING BTREE,
  INDEX `supplier_id`(`supplier_id` ASC) USING BTREE,
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `detail_master_values` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `products_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `detail_master_values` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `products_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `detail_master_values` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`made_in_id`) REFERENCES `detail_master_values` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `products_item_type_id_foreign` FOREIGN KEY (`item_type_id`) REFERENCES `detail_master_values` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `products_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `master_status` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `products_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `detail_master_values` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of products
-- ----------------------------
BEGIN;
INSERT INTO `products` (`id`, `product_name`, `category_id`, `detail`, `unit_id`, `product_code`, `weightKg`, `weight`, `min_stock`, `discount_percent`, `discount_price`, `bag`, `stock`, `buying_price`, `selling_price`, `product_image`, `created_at`, `updated_at`, `supplier_id`, `status_id`, `brand_id`, `grade_id`, `group_id`, `type_id`, `item_type_id`, `made_in_id`, `product_base_bag`) VALUES (20, 'Santana A', '1', NULL, '1', 'Santana A', 5, 5000, 1, 0, 0, 0, -6, 12000, NULL, NULL, '2024-03-29 13:17:41', '2024-05-18 14:45:44', 2, 1, 106, NULL, 108, NULL, NULL, NULL, 5), (21, 'FfGV5OOcRa', '1', NULL, '1', 'XVMBFdLnha', 0, 0, 1, 0, 0, 0, 0, NULL, NULL, NULL, '2024-03-29 13:22:22', '2024-03-29 13:22:22', NULL, 1, 106, NULL, 108, NULL, NULL, NULL, 1), (22, 'hSuX8Jrqvq', '1', NULL, '1', '0HQs8ZcElm', 0, 0, 1, 0, 0, 0, 0, NULL, NULL, NULL, '2024-03-29 13:23:01', '2024-03-29 13:23:01', NULL, 1, 106, NULL, 108, NULL, NULL, NULL, 1), (23, 'Santana B', '1', NULL, '1', 'SN B', 0, 0, 1, 0, 0, 0, 0, NULL, NULL, NULL, '2024-05-18 14:24:10', '2024-05-18 14:24:10', NULL, 1, 106, NULL, 108, NULL, NULL, NULL, 12), (24, 'Santana C', '1', NULL, '1', 'SN XZ', 0, 0, 1, 0, 0, 0, 2, NULL, NULL, NULL, '2024-05-18 14:24:52', '2024-05-18 14:45:44', NULL, 1, 106, NULL, 108, NULL, NULL, NULL, 1);
COMMIT;

-- ----------------------------
-- Table structure for purchase_details
-- ----------------------------
DROP TABLE IF EXISTS `purchase_details`;
CREATE TABLE `purchase_details`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `purchase_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `unitcost_selling` int NOT NULL DEFAULT 0,
  `unitcost` int NOT NULL,
  `total` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `weightKg` int NOT NULL,
  `weightGram` int NOT NULL,
  `bag` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of purchase_details
-- ----------------------------
BEGIN;
INSERT INTO `purchase_details` (`id`, `purchase_id`, `product_id`, `quantity`, `unitcost_selling`, `unitcost`, `total`, `created_at`, `updated_at`, `weightKg`, `weightGram`, `bag`) VALUES (19, '18', '20', 5, 0, 12000, 60000, '2024-04-14 05:59:39', NULL, 5, 5000, 0);
COMMIT;

-- ----------------------------
-- Table structure for purchases
-- ----------------------------
DROP TABLE IF EXISTS `purchases`;
CREATE TABLE `purchases`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_due_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `arrival_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `no_faktur_pajak_pembelian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description_purchase` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `purchase_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `purchase_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Approved',
  `total_amount_paid` int NOT NULL,
  `total_amount` int NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_id` bigint UNSIGNED NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `purchases_status_id_foreign`(`status_id` ASC) USING BTREE,
  CONSTRAINT `purchases_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `master_status` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of purchases
-- ----------------------------
BEGIN;
INSERT INTO `purchases` (`id`, `supplier_id`, `purchase_due_date`, `arrival_date`, `no_faktur_pajak_pembelian`, `description_purchase`, `purchase_date`, `purchase_no`, `purchase_status`, `total_amount_paid`, `total_amount`, `created_by`, `updated_by`, `created_at`, `updated_at`, `status_id`) VALUES (18, '2', '2024-04-14', '2024-04-14 06:01:54', NULL, NULL, '2024-04-14', 'POD-000002', '2', 60000, 60000, '1', '1', '2024-04-14 05:59:39', '2024-04-14 06:01:54', 1);
COMMIT;

-- ----------------------------
-- Table structure for return_purchase_details
-- ----------------------------
DROP TABLE IF EXISTS `return_purchase_details`;
CREATE TABLE `return_purchase_details`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `purchase_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `return_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `unitcost` int NOT NULL,
  `total` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of return_purchase_details
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for return_purchases
-- ----------------------------
DROP TABLE IF EXISTS `return_purchases`;
CREATE TABLE `return_purchases`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_faktur_pajak_pembelian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `return_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `return_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Approved',
  `total_amount` int NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `purchase_id` bigint UNSIGNED NULL DEFAULT 1,
  `status_id` bigint UNSIGNED NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `purchases_status_id_foreign`(`status_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of return_purchases
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id` ASC) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
BEGIN;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (1, 1), (2, 1), (3, 1), (4, 1), (1, 3);
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES (1, 'Admin', 'web', '2023-09-10 14:26:57', '2023-09-10 14:26:57'), (3, 'Admin_Sale', 'web', '2023-09-10 14:45:37', '2023-09-10 14:45:37');
COMMIT;

-- ----------------------------
-- Table structure for setting_generals
-- ----------------------------
DROP TABLE IF EXISTS `setting_generals`;
CREATE TABLE `setting_generals`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `my_company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_company_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_company_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of setting_generals
-- ----------------------------
BEGIN;
INSERT INTO `setting_generals` (`id`, `my_company_name`, `my_company_phone`, `my_company_address`, `created_at`, `updated_at`) VALUES (1, 'CV. MUSTIKA JAYA SANTARA', '0852-3133-8500', 'Jl. Kemuning Raya 04/05 Bojong Menteng\nRawalumbu, Kota Bekasi, Jawa Barat', '2024-04-14 13:15:41', '2024-04-14 13:15:38');
COMMIT;

-- ----------------------------
-- Table structure for shoppingcart
-- ----------------------------
DROP TABLE IF EXISTS `shoppingcart`;
CREATE TABLE `shoppingcart`  (
  `identifier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `instance` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`identifier`, `instance`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of shoppingcart
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for suppliers
-- ----------------------------
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `npwp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `shopname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `account_holder` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_id` bigint UNSIGNED NULL DEFAULT 1,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `company_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `suppliers_email_unique`(`email` ASC) USING BTREE,
  UNIQUE INDEX `suppliers_phone_unique`(`phone` ASC) USING BTREE,
  INDEX `suppliers_status_id_foreign`(`status_id` ASC) USING BTREE,
  CONSTRAINT `suppliers_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `master_status` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
BEGIN;
INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `address`, `npwp`, `shopname`, `type`, `photo`, `account_holder`, `account_number`, `bank_name`, `created_at`, `updated_at`, `status_id`, `company_name`, `company_phone`) VALUES (1, 'Pabrik Gulaku', 'supplier@mail.com', '31239102213902910', 'dnskakndknak', '6786767', 'supplier 1', 'Distributor', NULL, 'kdoaksdosa', '31293198', 'BNI', '2023-09-12 02:20:22', '2023-09-12 02:20:22', 1, 'PT HO', '93012392190'), (2, 'Another Pabrik Gulaku', 'supplier2@mail.com', '312391022139029210', 'dnskakndknak', '89907867', 'supplier 1', 'Distributor', NULL, 'kdoaksdosa', '31293198', 'BNI', '2023-09-12 02:20:22', '2023-09-12 02:20:22', 1, 'PT HA', '3901239120');
COMMIT;

-- ----------------------------
-- Table structure for units
-- ----------------------------
DROP TABLE IF EXISTS `units`;
CREATE TABLE `units`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_id` bigint UNSIGNED NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `units_name_unique`(`name` ASC) USING BTREE,
  UNIQUE INDEX `units_slug_unique`(`slug` ASC) USING BTREE,
  INDEX `units_status_id_foreign`(`status_id` ASC) USING BTREE,
  CONSTRAINT `units_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `master_status` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of units
-- ----------------------------
BEGIN;
INSERT INTO `units` (`id`, `name`, `slug`, `created_at`, `updated_at`, `status_id`) VALUES (1, 'GRAM', 'gram', '2024-01-12 00:29:56', '2024-01-12 00:29:56', 1);
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status_id` bigint UNSIGNED NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE,
  INDEX `users_status_id_foreign`(`status_id` ASC) USING BTREE,
  CONSTRAINT `users_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `master_status` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `username`, `photo`, `status_id`) VALUES (1, 'Dimas', 'admin@gmail.com', NULL, '$2y$10$4l6DaE1c7VpJdsNifIVw/uh8ocrGGpyEC5/cG3gL6u5YbTiltoX3O', 'wLgDJL5jt4JWZf7X0hRYHifALa5HKAcwttnBrJ9G7Md3xRl0k8NSlEXRFnZe', '2023-09-10 14:26:57', '2023-09-10 14:26:57', 'Dimas', NULL, 1), (2, 'Admin Penjualan', 'selleradmin@gmail.com', NULL, '$2y$10$Jk1oGN.JeWfeSHD2YGIwo.kRqsdlekRgV38XpSe/Ki25qi8tNqGAi', NULL, '2023-12-30 07:08:05', '2023-12-30 07:08:05', 'seller_admin', NULL, 1);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
