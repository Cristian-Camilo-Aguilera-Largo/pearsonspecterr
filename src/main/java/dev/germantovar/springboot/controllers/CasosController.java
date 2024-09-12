package dev.germantovar.springboot.controllers;
import dev.germantovar.springboot.entities.Casos;

import dev.germantovar.springboot.repository.CasosRepository;

import dev.germantovar.springboot.services.ICasosService;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;
import java.util.List;
//parcial
@RestController
public class CasosController {

    @Autowired
    private ICasosService service;


    @Autowired
    CasosRepository casosRepository;

    @GetMapping("tipificacion1")
    public List<Casos> getAll() {
        return service.getAll();
    }

    @PostMapping("envio")
    public void save(@RequestBody Casos customer){
        service.save(customer);
    }
}
