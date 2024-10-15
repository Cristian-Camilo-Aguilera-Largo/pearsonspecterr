package dev.germantovar.springboot.services;

import dev.germantovar.springboot.entities.Usuarios;
import dev.germantovar.springboot.repository.UsuariosRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import java.util.List;

@Service
public class UsuariosService implements IUsuariosService{

    @Autowired
    private UsuariosRepository repository;

    @Override
    public List<Usuarios> getAll(){
        return (List<Usuarios>) repository.findAll();
    }

    @Override
    public void save(Usuarios usuarios){
        repository.save(usuarios);
    }
}
