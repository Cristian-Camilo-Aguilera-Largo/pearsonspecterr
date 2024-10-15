package dev.germantovar.springboot.controllers;

import dev.germantovar.springboot.entities.Clientes;

import dev.germantovar.springboot.repository.ClientesRepository;

import dev.germantovar.springboot.services.IClientesService;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;
import java.util.List;

@RestController
public class ClientesController {

    @Autowired
    private IClientesService service;


    @Autowired
    ClientesRepository customerRepository;

    @GetMapping("clientes")
    public List<Clientes> getAll() {
        return service.getAll();
    }

    @PostMapping("envioclientes")
    public void save(@RequestBody Clientes clientes){
        service.save(clientes);
    }
}
