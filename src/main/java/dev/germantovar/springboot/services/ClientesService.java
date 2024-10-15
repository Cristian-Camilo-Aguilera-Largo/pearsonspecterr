package dev.germantovar.springboot.services;

import dev.germantovar.springboot.entities.Abogados;
import dev.germantovar.springboot.entities.Clientes;
import dev.germantovar.springboot.repository.ClientesRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class ClientesService implements IClientesService{

    @Autowired
    private ClientesRepository repository;

    @Override
    public List<Clientes> getAll(){
        return (List<Clientes>) repository.findAll();
    }

    @Override
    public void save(Clientes clientes){
        repository.save(clientes);
    }

}
