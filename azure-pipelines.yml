import tkinter as tk
from tkinter import messagebox
import mysql.connector
import pyotp
import hashlib

# Conexión a la base de datos en XAMPP
def conectar_db():
    try:
        conn = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",  # Usa tu contraseña de MySQL
            database="app_db"  # Nombre de la base de datos en XAMPP
        )
        return conn
    except mysql.connector.Error as err:
        messagebox.showerror("Error", f"No se pudo conectar a la base de datos: {err}")
        return None

# Hash de la contraseña
def hash_password(password):
    return hashlib.sha256(password.encode()).hexdigest()

# Registro de usuario
def registrar_usuario():
    conn = conectar_db()
    if conn:
        cursor = conn.cursor()
        nombre = entry_nombre.get()
        apellido = entry_apellido.get()
        email = entry_email.get()
        usuario = entry_usuario_reg.get()
        contraseña = hash_password(entry_contraseña.get())

        # Verificar si el usuario ya existe
        cursor.execute("SELECT * FROM usuarios WHERE usuario=%s", (usuario,))
        if cursor.fetchone():
            messagebox.showerror("Error", "El usuario ya está registrado.")
            return

        # Crear código de 2FA para el usuario
        totp = pyotp.TOTP(pyotp.random_base32())
        codigo_2fa = totp.now()

        # Insertar usuario en la base de datos
        cursor.execute("INSERT INTO usuarios (nombre, apellido, email, usuario, contraseña, codigo_2fa) VALUES (%s, %s, %s, %s, %s, %s)",
                       (nombre, apellido, email, usuario, contraseña, codigo_2fa))
        conn.commit()
        conn.close()

        messagebox.showinfo("Registro exitoso", "Usuario registrado correctamente.")
    else:
        messagebox.showerror("Error", "No se pudo registrar el usuario.")

# Inicio de sesión
def iniciar_sesion():
    conn = conectar_db()
    if conn:
        cursor = conn.cursor()
        usuario = entry_usuario.get()
        contraseña = hash_password(entry_contraseña_login.get())

        # Verificar credenciales
        cursor.execute("SELECT * FROM usuarios WHERE usuario=%s AND contraseña=%s", (usuario, contraseña))
        user = cursor.fetchone()
        
        if user:
            # Solicitar código de 2FA
            totp = pyotp.TOTP(user[5])  # Obtener el código_2fa del usuario
            codigo_2fa = totp.now()
            codigo_ingresado = entry_2fa.get()

            if codigo_2fa == codigo_ingresado:
                messagebox.showinfo("Ingreso exitoso", "Has ingresado correctamente.")
            else:
                messagebox.showerror("Error de autenticación", "Código de 2FA incorrecto.")
        else:
            messagebox.showerror("Error", "Usuario o contraseña incorrectos.")
        conn.close()
    else:
        messagebox.showerror("Error", "No se pudo iniciar sesión.")

# Configuración de la ventana principal
ventana = tk.Tk()
ventana.title("Autenticación en la APP")
ventana.geometry("400x400")

# Campos de registro
tk.Label(ventana, text="Nombre").pack()
entry_nombre = tk.Entry(ventana)
entry_nombre.pack()

tk.Label(ventana, text="Apellido").pack()
entry_apellido = tk.Entry(ventana)
entry_apellido.pack()

tk.Label(ventana, text="Email").pack()
entry_email = tk.Entry(ventana)
entry_email.pack()

tk.Label(ventana, text="Usuario").pack()
entry_usuario_reg = tk.Entry(ventana)
entry_usuario_reg.pack()

tk.Label(ventana, text="Contraseña").pack()
entry_contraseña = tk.Entry(ventana, show="*")
entry_contraseña.pack()

tk.Button(ventana, text="Registrar", command=registrar_usuario).pack(pady=10)

# Separador
tk.Label(ventana, text="=======================").pack()

# Campos de inicio de sesión
tk.Label(ventana, text="Usuario").pack()
entry_usuario = tk.Entry(ventana)
entry_usuario.pack()

tk.Label(ventana, text="Contraseña").pack()
entry_contraseña_login = tk.Entry(ventana, show="*")
entry_contraseña_login.pack()

tk.Label(ventana, text="Código de 2FA").pack()
entry_2fa = tk.Entry(ventana)
entry_2fa.pack()

tk.Button(ventana, text="Iniciar sesión", command=iniciar_sesion).pack(pady=10)

ventana.mainloop()