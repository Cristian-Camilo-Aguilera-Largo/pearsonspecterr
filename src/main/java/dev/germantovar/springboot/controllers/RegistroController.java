package dev.germantovar.springboot.controllers;

import dev.germantovar.springboot.VM.RegistroVM;
import dev.germantovar.springboot.entities.Roles;
import dev.germantovar.springboot.entities.Usuarios;
import dev.germantovar.springboot.entities.Clientes;
import dev.germantovar.springboot.repository.ClientesRepository;
import dev.germantovar.springboot.repository.RolesRepository;
import dev.germantovar.springboot.repository.UsuariosRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

import java.util.Optional;

@RestController
public class RegistroController {

    @Autowired
    private UsuariosRepository usuariosRepository;

    @Autowired
    private RolesRepository rolesRepository;

    @Autowired
    private ClientesRepository clientesRepository;

    /**
     * Endpoint para registrar un nuevo Usuario y Cliente.
     * @param registroVM los datos del usuario y cliente a registrar
     * @return respuesta con el estado de la operación
     */
    @PostMapping("/registro")
    public ResponseEntity<String> registrarUsuarioYCliente(@RequestBody RegistroVM registroVM) {
        // 1. Crear el Usuario
        Usuarios usuario = new Usuarios();
        usuario.setUser(registroVM.getUsername());
        usuario.setPass(registroVM.getPassword());

        // 2. Obtener y asignar el rol predeterminado al Usuario (en este caso, rol con id = 3)
        Optional<Roles> rolOpt = rolesRepository.findById(3L); // Asegúrate que el ID 3L corresponde a un rol válido
        if (!rolOpt.isPresent()) {
            return new ResponseEntity<>("Rol no encontrado", HttpStatus.BAD_REQUEST);
        }
        Roles rol = rolOpt.get();
        usuario.setRoles(rol); // Asociar el rol al usuario

        // 3. Guardar el Usuario en la base de datos
        usuario = usuariosRepository.save(usuario);  // Guardo y recupero el objeto Usuario actualizado

        // 4. Crear el Cliente y asociarlo con el Usuario recién creado
        Clientes cliente = new Clientes();
        cliente.setNombre(registroVM.getNombre());
        cliente.setApellido(registroVM.getApellido());
        cliente.setTelefono(registroVM.getTelefono());
        cliente.setEmail(registroVM.getEmail());
        cliente.setUsuarios(usuario); // Asociar al Usuario creado

        // 5. Guardar el Cliente en la base de datos
        clientesRepository.save(cliente);

        // 6. Responder al cliente que se registró con éxito
        return new ResponseEntity<>("Usuario y Cliente registrados con éxito", HttpStatus.CREATED);
    }

}
