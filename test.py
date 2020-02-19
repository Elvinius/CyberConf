from flask import Flask

app = Flask(__name__)

def factors(num):
    return [x for x in range(1, num+1) if num%x==0]

@app.route("/")

def hello():
    return '<a href="/factor"> click here for an example</a>'

@app.route("/factor=<int:n>")
def display_factor(n):
    list_factor = factors(n)
    html = '<h1> factors of' + str(n)
    for f in list_factor:
        html += "<li>" + str(f) + "</li>" + "\n"
    html += "<ul </body"
    return html

@app.route('/<name>')

def wel(name):
    return "welcome " + name + "!"

if __name__ == '__main__':
    app.run()
