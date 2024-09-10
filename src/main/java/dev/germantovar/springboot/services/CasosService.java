package dev.germantovar.springboot.services;

import dev.germantovar.springboot.entities.Casos;
import dev.germantovar.springboot.repository.CasosRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class CasosService implements ICasosService {

    @Autowired
    private CasosRepository repository;

    @Override
    public List<Casos> getAll(){
        return (List<Casos>) repository.findAll();
    }

    @Override
    public void save(Casos customer){
        repository.save(customer);
    }
}
