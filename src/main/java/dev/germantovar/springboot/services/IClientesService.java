package dev.germantovar.springboot.services;

import dev.germantovar.springboot.entities.Clientes;

import java.util.List;

public interface IClientesService {
    List<Clientes> getAll();

    void save(Clientes clientes);
}
