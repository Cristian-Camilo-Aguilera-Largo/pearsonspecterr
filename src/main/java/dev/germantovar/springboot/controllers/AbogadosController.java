package dev.germantovar.springboot.controllers;
import dev.germantovar.springboot.entities.Abogados;

import dev.germantovar.springboot.repository.AbogadosRepository;

import dev.germantovar.springboot.services.IAbogadosService;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import java.util.List;
import java.util.Optional;

@RestController
public class AbogadosController {

    @Autowired
    private IAbogadosService service;


    @Autowired
    AbogadosRepository abogadosRepository;

    @GetMapping("abogados")
    public List<Abogados> getAll() {
        return service.getAll();
    }

    @PostMapping("envioabogados")
    public void save(@RequestBody Abogados abogados){
        service.save(abogados);
    }

    @DeleteMapping("envioabogados/eliminar/{id}")
    public void remove(@PathVariable String id) {
        service.remove(Long.parseLong(id)); // No es necesario convertir, ya que es Long
    }
}
