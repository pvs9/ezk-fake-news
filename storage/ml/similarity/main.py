from Similarity_Modul import *
import argparse

parser = argparse.ArgumentParser(description='Reliability prediction')
parser.add_argument('input_csv', type=str, help='Input csv path')
parser.add_argument('output_csv', type=str, help='Output csv path')
args = parser.parse_args()

Similarity = similarity(args.input_csv,'/var/www/html/storage/ml/similarity/articles_mos_9.csv')
Similarity.clean_data()
result = Similarity.similarity()

result.to_csv(args.output_csv, index = False)
