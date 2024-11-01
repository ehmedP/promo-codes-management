package com.example.utils;

import java.util.List;

import javax.sql.DataSource;

import com.zaxxer.hikari.HikariConfig;
import com.zaxxer.hikari.HikariDataSource;

import io.github.cdimascio.dotenv.Dotenv;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

public class PromoCodeInserter {
    private static final Logger logger = LoggerFactory.getLogger(PromoCodeInserter.class);
    private static final Dotenv dotenv = Dotenv.load();

    private static DataSource createDataSource() {
        HikariConfig config = new HikariConfig();

        config.setJdbcUrl(dotenv.get("DB_URL"));
        config.setUsername(dotenv.get("DB_USER"));
        config.setPassword(dotenv.get("DB_PASSWORD"));
        config.setMaximumPoolSize(10);
        config.setConnectionTimeout(30000);
        config.setIdleTimeout(600000);

        return new HikariDataSource(config);
    }

    public static void fileInsertSql(String TXT_DIRECTORY) {

        PromoCodeService promoCodeService = new PromoCodeService(createDataSource());
        List<String> promoCodes = FileService.readPromoCodesFromTxt(TXT_DIRECTORY);
        
        if (!promoCodes.isEmpty()) {
            promoCodeService.insertPromoCodes(promoCodes);
        } else {
            logger.warn("No promo codes found.");
        }
    }
}