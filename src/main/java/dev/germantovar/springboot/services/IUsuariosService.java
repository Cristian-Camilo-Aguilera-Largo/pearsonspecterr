package dev.germantovar.springboot.services;

import dev.germantovar.springboot.entities.Usuarios;
import  java.util.List;

public interface IUsuariosService {
    List<Usuarios> getAll();

    void save(Usuarios usuarios);
}
