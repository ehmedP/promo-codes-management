package com.example.utils;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.util.List;

import javax.sql.DataSource;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

public class PromoCodeService {
    private static final Logger logger = LoggerFactory.getLogger(PromoCodeService.class);
    private final DataSource dataSource;
    private static final String INSERT_QUERY = "INSERT INTO promo_codes (code) VALUES (?)";

    public PromoCodeService(DataSource dataSource) {
        this.dataSource = dataSource;
    }

    public void insertPromoCodes(List<String> promoCodes) {
        try (Connection conn = dataSource.getConnection();
             PreparedStatement stmt = conn.prepareStatement(INSERT_QUERY)) {
             
            for (String code : promoCodes) {
                stmt.setString(1, code);
                stmt.addBatch();
            }
            
            int[] updateCounts = stmt.executeBatch();
            logger.info(updateCounts.length + " promocode added sql.");
        } catch (SQLException e) {
            logger.error("Error while adding to database.", e);
        }
    }
}
