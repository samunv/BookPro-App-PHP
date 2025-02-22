<?php
class Sesion
{
	private $usuario;

	public function __construct()
	{
		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}

		// Asegurarse de que la variable de sesión esté definida
		$this->usuario = $_SESSION['usuario'] ?? null;
	}

	public function setUsuario($usuario)
	{
		$_SESSION['usuario'] = $usuario;
		$this->usuario = $usuario;
	}

	public function getUsuario()
	{
		return $this->usuario;
	}

	public function setUsuarioProvisional($usuario_provisional)
	{
		$_SESSION['usuario_provisional'] = $usuario_provisional;
	}

	public function getUsuarioProvisional()
	{
		return $_SESSION['usuario_provisional'] ?? null;
	}

	public function cerrarSesion()
	{
		session_unset();
		session_destroy();
		setcookie(session_name(), '', time() - 3600, '/');
	}
}
