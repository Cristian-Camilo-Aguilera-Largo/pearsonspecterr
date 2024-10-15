package dev.germantovar.springboot.controllers;
import lombok.Getter;
import lombok.Setter;

@Getter
@Setter
public class CasosRequest {
    private Long idAbogado; // El ID del abogado
    private String caso;
    private String descripcion;
    private String fechaIc;
    private String estado;
    private String fechaCt;
    private Long idClientes;
}
