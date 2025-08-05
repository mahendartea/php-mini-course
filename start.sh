#!/bin/bash

# PHP Mini Course - Docker Quick Start Script
# Script untuk memudahkan menjalankan course dengan Docker

echo "🐳 PHP Mini Course - Docker Setup"
echo "=================================="

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo "❌ Docker tidak berjalan. Pastikan Docker Desktop sudah dijalankan."
    exit 1
fi

echo "✅ Docker detected"

# Check if docker-compose.yml exists
if [ ! -f "docker-compose.yml" ]; then
    echo "❌ File docker-compose.yml tidak ditemukan"
    exit 1
fi

echo "✅ docker-compose.yml found"

# Start the containers
echo "🚀 Starting PHP Mini Course server..."
docker-compose up -d

# Wait a moment for container to start
sleep 3

# Check if container is running
if docker-compose ps | grep -q "Up"; then
    echo "✅ Server berhasil dijalankan!"
    echo ""
    echo "🌐 Akses course di:"
    echo "   http://localhost:8080"
    echo ""
    echo "📚 Mulai dengan pertemuan 1:"
    echo "   http://localhost:8080/pertemuan-01/"
    echo ""
    echo "🛑 Untuk stop server:"
    echo "   docker-compose down"
else
    echo "❌ Gagal menjalankan server"
    echo "🔍 Cek logs dengan: docker-compose logs"
fi
