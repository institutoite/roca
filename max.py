def numero_menor(a, b, c):
    suma = a + b + c
    maximo = max(a, b, c)
    diferencia_absoluta = abs(suma - 2 * maximo)
    return (suma - diferencia_absoluta) // 3

resultado = numero_menor(10, 5, 8)
print("El número menor es:", resultado)