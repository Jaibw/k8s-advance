def start(request):
    request_json = request.get_json()
    a=0
    b=0
    if request_json and 'a' in request_json:
        a = int(request_json['a'])
    if request_json and 'b' in request_json:
        b = int(request_json['b'])
    result = a + b 
    return f'sum: ' + str(result)
