package com.example.utils;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.ArrayList;
import java.util.List;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

public class FileService {
    private static final Logger logger = LoggerFactory.getLogger(FileService.class);

    public static List<String> readPromoCodesFromTxt(String directoryPath) {
        List<String> promoCodes = new ArrayList<>();
        
        try {
            Files.walk(Paths.get(directoryPath)).filter(Files::isRegularFile).forEach(file -> {
                try (BufferedReader br = new BufferedReader(new FileReader(file.toFile()))) {
                    String line;
                    while ((line = br.readLine()) != null) {
                        promoCodes.add(line.trim());
                    }
                } catch (IOException e) {
                    logger.error("Error reading file: " + file.toString(), e);
                }
            });
        } catch (IOException e) {
            logger.error("Error reading directory.", e);
        }
        
        return promoCodes;
    }
}