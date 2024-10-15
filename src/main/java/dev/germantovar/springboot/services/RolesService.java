package dev.germantovar.springboot.services;

import dev.germantovar.springboot.entities.Roles;
import dev.germantovar.springboot.repository.RolesRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class RolesService implements IRolesService{
    @Autowired
    private RolesRepository repository;

    @Override
    public List<Roles> getAll(){return (List<Roles>) repository.findAll();}
}
