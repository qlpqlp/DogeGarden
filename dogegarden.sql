--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) NOT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'en',
  `id_cat` bigint(20) DEFAULT NULL,
  `id_prod` bigint(20) DEFAULT NULL,
  `id_page` bigint(20) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `ord` bigint(20) NOT NULL,
  `active` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) NOT NULL,
  `id_shibe` bigint(20) NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `session` varchar(255) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `lang` varchar(2) DEFAULT 'en',
  `icon` varchar(50) DEFAULT 'ellipsis-v',
  `id_cat` bigint(20) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `text` longtext,
  `img` varchar(255) DEFAULT NULL,
  `ord` int(1) DEFAULT NULL,
  `active` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `id_shibe` bigint(20) NOT NULL,
  `doge_in_address` varchar(255) DEFAULT NULL,
  `doge_out_address` varchar(255) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `total_doge` decimal(20,8) DEFAULT NULL,
  `doge_transaction_id` text,
  `confirmations` bigint(20) NOT NULL DEFAULT '0',
  `shipping` decimal(20,8) DEFAULT NULL,
  `products_json` longtext,
  `status` int(1) NOT NULL,
  `email_sent` int(1) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) NOT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'en',
  `id_page` bigint(20) NOT NULL DEFAULT '0',
  `type` int(10) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `text` longtext,
  `ord` bigint(20) DEFAULT '0',
  `active` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL,
  `id_cat` bigint(20) NOT NULL,
  `cat_tax` varchar(255) DEFAULT '0',
  `doge` decimal(20,8) NOT NULL,
  `fiat` decimal(20,8) NOT NULL,
  `moon_new` decimal(10,2) DEFAULT '0.00',
  `moon_full` decimal(10,2) DEFAULT NULL,
  `qty` bigint(11) DEFAULT '0',
  `weight` decimal(10,2) DEFAULT '0.00',
  `title` varchar(255) DEFAULT NULL,
  `text` longtext,
  `imgs` longtext,
  `highlighted` tinyint(1) DEFAULT '0',
  `ord` bigint(20) DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shibes`
--

CREATE TABLE `shibes` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tax_id` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `doge_address` varchar(255) NOT NULL,
  `active` int(1) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id` bigint(20) NOT NULL,
  `country` varchar(2) NOT NULL DEFAULT 'en',
  `title` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `doge` decimal(20,8) DEFAULT NULL,
  `fiat` decimal(20,8) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` bigint(20) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `country` varchar(2) NOT NULL DEFAULT 'en',
  `tax` decimal(10,4) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shibes`
--
ALTER TABLE `shibes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shibes`
--
ALTER TABLE `shibes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;