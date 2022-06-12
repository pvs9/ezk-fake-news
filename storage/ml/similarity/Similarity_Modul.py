#!/usr/bin/env python
# coding: utf-8

# In[41]:


from tensorflow import keras
import numpy as np
import tensorflow as tf
import pandas as pd
import nltk
from nltk.corpus import stopwords
from nltk.tokenize import RegexpTokenizer
import pymorphy2
from sklearn import metrics
from sklearn.feature_extraction.text import CountVectorizer
import itertools
from nltk.stem import PorterStemmer
import joblib
import glob
import difflib


class similarity():

        def __init__(self, search_file, source_file):
        # read the 'model' and 'cv' files which were saved
            self.text1 = pd.read_csv(search_file,  sep=",",  engine='python')
            self.text2 = pd.read_csv(source_file,  sep=",",  engine='python')
            self.data = None





        # take a data file (*.csv) and preprocess it
        def clean_data(self):
            col=['text']
            data_source=self.text2[col]
            data_check=self.text1

            nltk.download('stopwords', download_dir='/var/www/html/storage/ml/nltk_data')
            nltk.data.path.append('/var/www/html/storage/ml/nltk_data')
            stop_words = set(stopwords.words('russian'))
            nltk_tokenizer = RegexpTokenizer(r'[а-яёa-z]+')
            morph = pymorphy2.MorphAnalyzer()

            def text_preprocessing(text):
              words = nltk_tokenizer.tokenize(text.lower())
              lem_text = [morph.parse(w)[0].normal_form for w in words if w not in stop_words]
              return lem_text


            ps = PorterStemmer()
            s2 = []
            for i in range(0, len(data_source)):
                review = text_preprocessing(data_source['text'][i])
                review = [ps.stem(word) for word in review]
                review=" ".join(review)
                s2.append(review)

            ps = PorterStemmer()
            s1 = []
            for i in range(0, len(data_check)):
                review = text_preprocessing(data_check['text'][i])
                review = [ps.stem(word) for word in review]
                review=" ".join(review)
                s1.append(review)

            self.s2 = s2.copy()
            self.s1 = s1.copy()



        def similarity(self):
            if (self.s1 is not None):
              normalized1 = self.s1[0].lower()
              temp = []
              for i in range(0, len(self.s2)):
                normalized2 = self.s2[i].lower()
                matcher = difflib.SequenceMatcher(None, normalized1, normalized2)
                temp.append(matcher.ratio())
              self.text2['similarity']=temp
              col2=['title', 'date', 'similarity']
              Rez=self.text2[col2]
              return Rez[Rez['similarity']==Rez['similarity'].max()]

