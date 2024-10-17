package dev.germantovar.springboot.controllers;

import dev.germantovar.springboot.entities.Roles;
import dev.germantovar.springboot.repository.RolesRepository;
import dev.germantovar.springboot.services.IRolesService;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;
import java.util.List;

@RestController
public class RolesController {
    @Autowired
    private IRolesService service;


    @Autowired
    RolesRepository customerRepository;

    @GetMapping("roles")
    public List<Roles> getAll() {
        return service.getAll();
    }

}
