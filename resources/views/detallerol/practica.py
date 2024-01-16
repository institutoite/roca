#import inflect


def suma(x, y):
    return x + y

def resta(x, y):
    return x - y

def multiplicacion(x, y):
    return x * y

def division(x, y):
    if y != 0:
        return x / y
    else:
        return "Error: No se puede dividir por cero."

# Función para convertir números a texto
def numero_a_texto(num):
    p = inflect.engine()
    num_texto = p.number_to_words(num, andword=",")
    return f"{num} ({num_texto.capitalize()})"

# Función principal de la calculadora
def calculadora():
    print("Calculadora Simple con Variables")
    
    # Diccionario para almacenar variables y sus valores
    variables = {}

    while True:
        print("\n1. Suma")
        print("2. Resta")
        print("3. Multiplicación")
        print("4. División")
        print("5. Almacenar en variable")
        print("6. Mostrar variables")
        print("7. Salir")

        # Obtener la operación deseada del usuario
        operacion = input("Seleccione la operación (1/2/3/4/5/6/7): ")

        if operacion == '7':
            print("Saliendo de la calculadora.")
            break

        # Obtener los operandos del usuario
        num1 = float(input("Ingrese el primer número: "))
        num2 = float(input("Ingrese el segundo número: "))

        # Realizar la operación seleccionada
        if operacion == '1':
            resultado = suma(num1, num2)
        elif operacion == '2':
            resultado = resta(num1, num2)
        elif operacion == '3':
            resultado = multiplicacion(num1, num2)
        elif operacion == '4':
            resultado = division(num1, num2)
        elif operacion == '5':
            variable_nombre = input("Ingrese el nombre de la variable: ")
            variables[variable_nombre] = num1
            print(f"Variable '{variable_nombre}' almacenada con valor {num1}")
            continue
        elif operacion == '6':
            print("\nVariables almacenadas:")
            for nombre, valor in variables.items():
                print(f"{nombre}: {valor}")
            continue
        else:
            print("Operación no válida. Inténtelo de nuevo.")
            continue

        # Convertir el resultado a texto antes de imprimirlo
        resultado_texto = numero_a_texto(resultado)
        print("Resultado:", resultado_texto)

# Llamar a la función de la calculadora
calculadora()
