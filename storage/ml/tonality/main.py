from Sentiments_Modul import *
import argparse

parser = argparse.ArgumentParser(description='Reliability prediction')
parser.add_argument('input_csv', type=str, help='Input csv path')
parser.add_argument('output_csv', type=str, help='Output csv path')
args = parser.parse_args()

modelS = predict_sentiments('/var/www/html/storage/ml/tonality/NN','/var/www/html/storage/ml/reliability/vectorizer_sentiments.pkl')
modelS.load_and_clean_data(args.input_csv)

result = modelS.predicted_outputs()
result.to_csv(args.output_csv, index = False)
