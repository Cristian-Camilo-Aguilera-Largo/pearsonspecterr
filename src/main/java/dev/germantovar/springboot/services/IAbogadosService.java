package dev.germantovar.springboot.services;
import dev.germantovar.springboot.entities.Abogados;
import  java.util.List;

public interface IAbogadosService {
    List<Abogados> getAll();

    void save(Abogados abogados);

    void remove(Long parseLong);
}
