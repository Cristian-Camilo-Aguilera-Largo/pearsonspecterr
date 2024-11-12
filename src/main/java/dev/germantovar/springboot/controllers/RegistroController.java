package dev.germantovar.springboot.controllers;

import dev.germantovar.springboot.VM.RegistroVM;
import dev.germantovar.springboot.entities.Roles;
import dev.germantovar.springboot.entities.Usuarios;
import dev.germantovar.springboot.entities.Clientes;
import dev.germantovar.springboot.repository.ClientesRepository;
import dev.germantovar.springboot.repository.RolesRepository;
import dev.germantovar.springboot.repository.UsuariosRepository;
import dev.germantovar.springboot.services.ClientesService;
import dev.germantovar.springboot.services.RolesService;
import dev.germantovar.springboot.services.UsuariosService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.Optional;
@RequestMapping("/registro")
@RestController
public class RegistroController {

    @Autowired
    private UsuariosService usuariosService;

    @Autowired
    private ClientesService clientesService;

    @Autowired
    private RolesService rolesService;


    // Endpoint para registrar un cliente
    @PostMapping("/cliente")
    public String registrarCliente(@RequestBody Clientes cliente) {
        clientesService.registrar(cliente);
        return "Cliente registrado exitosamente!";
    }

    @PostMapping("/usuario")
    public String registrarUsuario(@RequestBody Usuarios usuario) {
        // Verifica los valores recibidos
        System.out.println("User: " + usuario.getUser());
        System.out.println("Pass: " + usuario.getPass());

        // Asignar rol predeterminado
        Roles rolPredeterminado = rolesService.getAll().stream()
                .filter(rol -> rol.getId_rol().equals(3L)) // Usa el getter correcto getId_rol()
                .findFirst()
                .orElseThrow(() -> new RuntimeException("Rol no encontrado"));

        usuario.setRoles(rolPredeterminado);

        // Guardar el usuario
        usuariosService.registrar(usuario);
        return "Usuario registrado exitosamente!";
    }






}
