/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.nora.util;

import java.util.HashMap;
import org.apache.commons.lang3.StringUtils;

/**
 *
 * @author Chris
 */
public class MapUtils {
    
    public static HashMap<String, Integer> rollupMaps(HashMap<String, Integer> map1, HashMap<String, Integer> map2){
      for(String key: map2.keySet()){
          map2.put(key, map2.get(key) + map1.get(key));
      }
      
      return map2;
  }
  
  
 
  
  public static <K, V> HashMap<K, V> initializeMaps(K[] keys, V[] values){
      HashMap<K, V> returnMap = new HashMap<K, V>();
      int i = 0;
      for(; i < keys.length; i++){
          returnMap.put(keys[i], values[i]);
      }
      return returnMap;
  }
  
  
  public static <K, V extends Number> HashMap<K, V> initializeMaps(K[] keys, V type){
      HashMap<K, V> returnMap = new HashMap<K, V>();
      
      for(K str: keys){
          returnMap.put(str, type);
      }
      return returnMap;
  }
}
