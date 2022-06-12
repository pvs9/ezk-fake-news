#!/usr/bin/env python
# coding: utf-8

# In[84]:


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

class predict_sentiments():

        def __init__(self, path_file, cv_file):
            # read the 'model' and 'cv' files which were saved

            with open(cv_file, 'rb') as cv_file:
                self.nn = keras.models.load_model(path_file)
                self.cv = joblib.load(cv_file)
                self.data = None

        # take a data file (*.csv) and preprocess it
        def load_and_clean_data(self, data_file):

            # import the data

            fake_raw=pd.read_csv(data_file,  sep=",",  engine='python')
            nltk.download('stopwords', download_dir='/var/www/html/storage/ml/nltk_data')
            stop_words = set(stopwords.words('russian'))
            nltk_tokenizer = RegexpTokenizer(r'[а-яёa-z]+')

            morph = pymorphy2.MorphAnalyzer()

            def text_preprocessing(text):
                    words = nltk_tokenizer.tokenize(text.lower())
                    lem_text = [morph.parse(w)[0].normal_form for w in words if w not in stop_words]

                    return lem_text


            ps = PorterStemmer()
            temp = []
            for i in range(0, len(fake_raw)):
                review = text_preprocessing(fake_raw['text'][i])
                review = [ps.stem(word) for word in review]
                review=" ".join(review)
                temp.append(review)

            self.preprocessed_data = fake_raw.copy()
            self.data = self.cv.transform(temp)



        def predicted_outputs(self):
            if (self.data is not None):
                tempo=self.nn.predict(self.data)

                self.preprocessed_data['Sentiments'] = tempo
                return self.preprocessed_data

