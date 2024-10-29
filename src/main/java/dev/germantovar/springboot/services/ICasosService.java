package dev.germantovar.springboot.services;
import dev.germantovar.springboot.entities.Casos;
import  java.util.List;

public interface ICasosService {
    List<Casos> getAll();

    void save(Casos casos);

    void remove(Long parseLong);
}
