#!/bin/zsh

podman machine init -v ./:/app laravel_tutorial

podman machine start laravel_tutorial
