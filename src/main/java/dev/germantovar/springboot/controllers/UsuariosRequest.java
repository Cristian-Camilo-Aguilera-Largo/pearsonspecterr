package dev.germantovar.springboot.controllers;

import lombok.Getter;
import lombok.Setter;

@Getter
@Setter
public class UsuariosRequest {
    private Long idRol; // El ID del abogado
    private String User;
    private String Pass;
}
