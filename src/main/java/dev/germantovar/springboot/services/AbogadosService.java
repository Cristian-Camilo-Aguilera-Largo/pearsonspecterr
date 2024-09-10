package dev.germantovar.springboot.services;

import dev.germantovar.springboot.entities.Abogados;
import dev.germantovar.springboot.repository.AbogadosRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class AbogadosService implements IAbogadosService {

    @Autowired
    private AbogadosRepository repository;

    @Override
    public List<Abogados> getAll(){
        return (List<Abogados>) repository.findAll();
    }

    @Override
    public void save(Abogados abogados){
        repository.save(abogados);
    }
}
