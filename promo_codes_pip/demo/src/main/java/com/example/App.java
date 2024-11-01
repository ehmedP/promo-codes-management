package com.example;

import java.util.ArrayList;
import java.util.List;

import com.example.utils.PromoCodeInserter;

public class App {
    
    public static void main(String[] args) {
        
        List<String> promoCodesDirArray = new ArrayList<String>();

        promoCodesDirArray.add("txt file address...");

        promoCodesDirArray.stream().forEach(item -> PromoCodeInserter.fileInsertSql(item) );

    }

}
