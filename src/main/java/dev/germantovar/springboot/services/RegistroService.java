package dev.germantovar.springboot.services;

import dev.germantovar.springboot.VM.RegistroVM;
import dev.germantovar.springboot.entities.Clientes;
import dev.germantovar.springboot.entities.Usuarios;
import dev.germantovar.springboot.repository.ClientesRepository;
import dev.germantovar.springboot.repository.UsuariosRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class RegistroService {
    @Autowired
    private UsuariosRepository usuariosRepository;

    @Autowired
    private ClientesRepository clientesRepository;

    public void registrarUsuario(RegistroVM registroVM) {
        // Guardar en Usuarios
        Usuarios usuario = new Usuarios();
        usuario.setUser(registroVM.getUsername());
        usuario.setPass(registroVM.getPassword());
        Usuarios usuarioGuardado = usuariosRepository.save(usuario);

        // Guardar en Clientes
        Clientes cliente = new Clientes();
        cliente.setNombre(registroVM.getNombre());
        cliente.setApellido(registroVM.getApellido());
        cliente.setTelefono(registroVM.getTelefono());
        cliente.setEmail(registroVM.getEmail());
        cliente.setUsuarios(usuarioGuardado);
        clientesRepository.save(cliente);
    }
}