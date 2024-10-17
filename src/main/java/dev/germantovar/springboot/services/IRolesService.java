package dev.germantovar.springboot.services;

import dev.germantovar.springboot.entities.Roles;

import java.util.List;

public interface IRolesService {
    List<Roles> getAll();
}
