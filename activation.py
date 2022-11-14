#!/usr/bin/python3

import requests
import sys

r = requests.post('https://192.168.1.5/activation.php', data={'serial': sys.argv[1]}, verify=False)
print()
print(r.status_code)
print()
print(r.text)
