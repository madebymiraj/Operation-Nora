/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.nora.test;


import java.io.BufferedReader;
import java.io.FileReader;
import java.util.List;

import edu.stanford.nlp.ling.Sentence;
import edu.stanford.nlp.ling.TaggedWord;
import edu.stanford.nlp.ling.HasWord;
import edu.stanford.nlp.tagger.maxent.MaxentTagger;
import java.io.File;
import java.io.InputStream;
import java.util.HashMap;
import java.util.Properties;
import org.apache.commons.lang3.StringUtils;

class Demo {

 
  public static void main(String[] args) throws Exception {
   
    String taggerFile = "D:/Temp/english-left3words-distsim.tagger";
    
    List<TaggedWord> tSentence = null;
    HashMap<String, Integer> values = null;
    HashMap<String, Integer> total = initializeMaps(new String[]{"verbs","nouns","adjectives"}, 0);
    System.out.println("test");
    String testFile = "D:/Temp/test.txt";
    MaxentTagger tagger = new MaxentTagger(taggerFile);
    List<List<HasWord>> sentences = MaxentTagger.tokenizeText(new BufferedReader(new FileReader(testFile)));
    for (List<HasWord> sentence : sentences) {
      tSentence = tagger.tagSentence(sentence);
      System.out.println(Sentence.listToString(tSentence, false));
      values = countParts(Sentence.listToString(tSentence, false));
        for(String str: values.keySet()){
            System.out.println(str + ": " + values.get(str));
        }
      total = rollupMaps(values, total);
    }
   System.out.println("Totals for the file " + testFile);
   for(String str: total.keySet()){
       System.out.println(str + " " + values.get(str));
   }
  }
  
  private static HashMap<String, Integer> rollupMaps(HashMap<String, Integer> map1, HashMap<String, Integer> map2){
      for(String key: map2.keySet()){
          map2.put(key, map2.get(key) + map1.get(key));
      }
      
      return map2;
  }
  
  
  private static HashMap<String, Integer> countParts(String str){
      HashMap<String, Integer> values = initializeMaps(new String[] {"verbs", "nouns", "adjectives"}, 0);
      HashMap<String, String> mappings = initializeMaps(new String[] {"verbs", "nouns", "adjectives"},
              new String[] {"VB", "NN", "JJ"});
      
      for(String partType: mappings.keySet()){
          values.put(partType, StringUtils.countMatches(str, mappings.get(partType)));
      }
      
      return values;
    }
  
  private static <K, V> HashMap<K, V> initializeMaps(K[] keys, V[] values){
      HashMap<K, V> returnMap = new HashMap<K, V>();
      int i = 0;
      for(; i < keys.length; i++){
          returnMap.put(keys[i], values[i]);
      }
      return returnMap;
  }
  
  
  private static <K, V extends Number> HashMap<K, V> initializeMaps(K[] keys, V type){
      HashMap<K, V> returnMap = new HashMap<K, V>();
      
      for(K str: keys){
          returnMap.put(str, type);
      }
      return returnMap;
  }

}