package dev.germantovar.springboot.controllers;

import dev.germantovar.springboot.entities.Casos;

import dev.germantovar.springboot.entities.Clientes;
import dev.germantovar.springboot.repository.CasosRepository;

import dev.germantovar.springboot.services.ICasosService;

import dev.germantovar.springboot.services.IClientesService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;
import java.util.List;

@RequestMapping("/Clientes")
@RestController
public class ClientesController {

    @Autowired
    private IClientesService service;


    @Autowired
    CasosRepository customerRepository;

    @GetMapping("/clientes")
    public List<Clientes> getAll() {
        return service.getAll();
    }

    @PostMapping("/envioclientes")
    public void save(@RequestBody Clientes clientes){
        service.save(clientes);
    }
}
