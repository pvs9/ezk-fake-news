from FakeNews_Modul import *
import argparse

parser = argparse.ArgumentParser(description='Reliability prediction')
parser.add_argument('input_csv', type=str, help='Input csv path')
parser.add_argument('output_csv', type=str, help='Output csv path')
args = parser.parse_args()

modelNN = predict_fake('/var/www/html/storage/ml/reliability/NN', '/var/www/html/storage/ml/reliability/vectorizer.pkl')
modelNN.load_and_clean_data(args.input_csv)

result = modelNN.predicted_outputs()
result.to_csv(args.output_csv, index = False)
