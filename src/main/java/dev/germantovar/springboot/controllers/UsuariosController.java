package dev.germantovar.springboot.controllers;

import dev.germantovar.springboot.entities.*;
import dev.germantovar.springboot.repository.RolesRepository;
import dev.germantovar.springboot.repository.UsuariosRepository;
import dev.germantovar.springboot.services.IUsuariosService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import java.util.List;
import java.util.Optional;

@RestController
public class UsuariosController {
    @Autowired
    private IUsuariosService service;

    @Autowired
    UsuariosRepository usuariosRepository;

    @Autowired
    RolesRepository rolesRepository;

    @GetMapping("usuarios")
    public List<Usuarios> getAll() {
        return service.getAll();
    }

    @PostMapping("enviousuarios")
    public ResponseEntity<?> save(@RequestBody UsuariosRequest usuariosRequest) {
        try {
            // Busca el abogado por su ID
            Roles roles = rolesRepository.findById(usuariosRequest.getIdRol())
                    .orElseThrow(() -> new RuntimeException("Rol no encontrado"));

            Usuarios usuarios = new Usuarios();
            usuarios.setRoles(roles); // Asigna el objeto Abogados al caso
            usuarios.setUser(usuariosRequest.getUser());
            usuarios.setPass(usuariosRequest.getPass());

            service.save(usuarios);
            return ResponseEntity.ok(usuarios); // Retorna el caso guardado como respuesta
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).body("Error: " + e.getMessage());
        }
    }
}
