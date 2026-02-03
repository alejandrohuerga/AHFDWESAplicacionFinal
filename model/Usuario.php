<?php

/**
 * Clase que representa un Usuario.
 * 
 * Clase que nos permitre crear objetos de Usuario.
 * 
 * @author Alejandro De la Huerga Fernández
 * @version 1.0.0 Fecha última modificación: 18/12/2025
 * @since 14/01/2026
*/
class Usuario
{
    private $codUsuario;
    private $password;
    private $descUsuario;
    private $numAccesos;
    private $fechaHoraUltimaConexion;
    private $fechaHoraUltimaConexionAnterior;
    private $perfil;
    private $imagenUsuario;

    /**
     * Function __construct
     * Función constructor para crear un objeto usuario.
     * 
     * @param String $codUsuario Cadena del codigo de usuario, max length=8.
     * @param String $password Cadena de la password de usuario, max length=64.
     * @param String $descUsuario Cadena de la descripción de usuario, max length=255.
     * @param int $numAccesos número de accesos del usuario.
     * @param String $fechaHoraUltimaConexión fecha y hora de la última conexión.
     * @param String $fechaHoraUltimaConexiónAnterior fecha y hora de la conexión anterior.
     * @param String $perfil Opcional. Cadena con el valor 'administrador o 'usuario' por defecto 'usuario'.
     * @param String | null Imagen del perfil del usuario.
     */
    public function __construct($codUsuario, $password, $descUsuario, $numAccesos, $fechaHoraUltimaConexionAnterior, $perfil, $imagenUsuario)
    {
        $this->codUsuario = $codUsuario;
        $this->password = $password;
        $this->descUsuario = $descUsuario;
        $this->numAccesos = $numAccesos;

        // La conexión actual siempre es "ahora" al loguearse
        $this->fechaHoraUltimaConexion = new DateTime( "now");
        $this->fechaHoraUltimaConexionAnterior = $fechaHoraUltimaConexionAnterior;
        $this->perfil = $perfil;
        $this->imagenUsuario = $imagenUsuario;
    }

    /**
     * Get the value of codUsuario
     */
    public function getCodUsuario()
    {
        return $this->codUsuario;
    }

    /**
     * Set the value of codUsuario
     */
    public function setCodUsuario($codUsuario): self
    {
        $this->codUsuario = $codUsuario;
        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get the value of descUsuario
     */
    public function getDescUsuario()
    {
        return $this->descUsuario;
    }

    /**
     * Set the value of descUsuario
     */
    public function setDescUsuario($descUsuario): self
    {
        $this->descUsuario = $descUsuario;
        return $this;
    }

    /**
     * Get the value of numAccesos
     */
    public function getNumAccesos()
    {
        return $this->numAccesos;
    }

    /**
     * Set the value of numAccesos
     */
    public function setNumAccesos($numAccesos): self
    {
        $this->numAccesos = $numAccesos;
        return $this;
    }

    /**
     * Get the value of fechaHoraUltimaConexion
     */
    public function getFechaHoraUltimaConexion()
    {
        return $this->fechaHoraUltimaConexion;
    }

    /**
     * Set the value of fechaHoraUltimaConexion
     */
    public function setFechaHoraUltimaConexion($fechaHoraUltimaConexion): self
    {
        $this->fechaHoraUltimaConexion = $fechaHoraUltimaConexion;
        return $this;
    }

    /**
     * Get the value of fechaHoraUltimaConexionAnterior
     */
    public function getFechaHoraUltimaConexionAnterior()
    {
        return $this->fechaHoraUltimaConexionAnterior;
    }

    /**
     * Set the value of fechaHoraUltimaConexionAnterior
     */
    public function setFechaHoraUltimaConexionAnterior($fechaHoraUltimaConexionAnterior): self
    {
        $this->fechaHoraUltimaConexionAnterior = $fechaHoraUltimaConexionAnterior;
        return $this;
    }

    /**
     * Get the value of perfil
     */
    public function getPerfil()
    {
        return $this->perfil;
    }

    /**
     * Set the value of perfil
     */
    public function setPerfil($perfil): self
    {
        $this->perfil = $perfil;
        return $this;
    }

    public function getImagenUsuario()
    {
        return $this->imagenUsuario;
    }

    public function setImagenUsuario($imagenUsuario)
    {
        $this->imagenUsuario = $imagenUsuario;
        return $this;
    }
}