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
public class TagGen {
     public static HashMap<String, Integer> countParts(String str){
      HashMap<String, Integer> values = MapUtils.initializeMaps(new String[] {"verbs", "nouns", "adjectives"}, 0);
      HashMap<String, String> mappings = MapUtils.initializeMaps(new String[] {"verbs", "nouns", "adjectives"},
              new String[] {"VB", "NN", "JJ"});
      
      for(String partType: mappings.keySet()){
          values.put(partType, StringUtils.countMatches(str, mappings.get(partType)));
      }
      
      return values;
    }
}
