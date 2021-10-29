#!/bin/bash

dogit() {
git add .
git commit -m "version_vom_$(date +%F_%H-%M-%S)"
git push
}
