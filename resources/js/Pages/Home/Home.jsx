import React, { useState } from "react";
import { Input } from "@/Components/ui/input";
import { Label } from "@/Components/ui/label";
import { Button } from "@/Components/ui/button";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/Components/ui/select";
import { useForm } from "@inertiajs/inertia-react";

export default function Home() {
    const [selectedType, setSelectedType] = useState("title");
    const { data, setData, get, processing } = useForm({
        search: "",
        type: "",
        page: "",
    });
    const handleSearch = (e) => {
        e.preventDefault();
        get("/books", {
            data,
            preserveScroll: true,
            preserveState: true,
            onError: (e) => console.log(e),
        });
    };
    return (
        <div className="relative h-screen flex flex-col items-center justify-center md:grid lg:max-w-none lg:grid-cols-2 lg:px-0">
            <div className="md:h-full w-full flex justify-center items-center">
                <img
                    src="./books.png"
                    alt=""
                    className="absolute max-h-screen flex-col object-fill w-full h-full block lg:hidden top-0 left-0"
                />
                <div className="z-10 bg-white p-10 rounded-md mx-6">
                    <div className="flex items-center p-4 justify-center">
                        <img
                            src="/img/logo_skanka.png"
                            alt="logo_skanka"
                            className="w-26 h-24 mr-2"
                        />
                        <h1 className="text-3xl font-extrabold text-center lg:text-5xl">
                            SMK 1 KASREMAN
                        </h1>
                    </div>
                    <p className="text-center text-2xl text-[#828282] tracking-wide w-full mt-4">
                        Katalog Buku Online yang Terintegrasi pada Koleksi
                        Perpustakaan
                    </p>
                    <hr className="my-10" />
                    <div className="w-full">
                        <h1 className="text-3xl font-bold text-center mb-3">
                            Pencarian Buku
                        </h1>
                        <div className="grid grid-cols-1 w-full justify-end gap-6">
                            <div className="col-span-full flex flex-col justify-end">
                                <Label
                                    htmlFor="title"
                                    className="text-2xl font-semibold"
                                >
                                    Tipe Kunci
                                </Label>
                                <Select
                                    defaultValue={selectedType}
                                    id="title"
                                    name="title"
                                    onValueChange={(e) => {
                                        setSelectedType(e);
                                        setData("type", e);
                                    }}
                                >
                                    <SelectTrigger className="text-xl font-semibold h-full p-4 mt-4 border-[#BDBDBD] w-full">
                                        <SelectValue />
                                    </SelectTrigger>
                                    <SelectContent className="text-xl font-normal">
                                        <SelectItem
                                            className="text-xl font-normal"
                                            value="title"
                                        >
                                            Judul
                                        </SelectItem>
                                        <SelectItem
                                            className="text-xl font-normal"
                                            value="genre"
                                        >
                                            Genre
                                        </SelectItem>
                                        <SelectItem
                                            className="text-xl font-normal"
                                            value="year"
                                        >
                                            Tahun
                                        </SelectItem>
                                        <SelectItem
                                            className="text-xl font-normal"
                                            value="location"
                                        >
                                            Lokasi
                                        </SelectItem>
                                    </SelectContent>
                                </Select>
                            </div>
                            <div className="col-span-full flex flex-col justify-end">
                                <Label
                                    htmlFor="title"
                                    className="text-2xl font-semibold"
                                >
                                    Kata Kunci
                                </Label>
                                <Input
                                    type="text"
                                    value={data.search}
                                    onChange={(e) =>
                                        setData({
                                            ...data,
                                            search: e.target.value,
                                        })
                                    }
                                    id="title"
                                    name="title"
                                    className="text-2xl px-4 py-3 mt-4 placeholder:text-[#A0A0A0] border-[#BDBDBD]"
                                    placeholder="Ketik kata kunci pencarian"
                                />
                            </div>
                            <div className="col-span-full flex justify-end flex-col">
                                <Button
                                    className="w-full bg-[#0B96F7] px-6 py-4 font-semibold tracking-wider text-xl rounded-xl"
                                    onClick={handleSearch}
                                    disabled={processing || data.search === ""}
                                >
                                    CARI
                                </Button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img
                src="./books.png"
                alt=""
                className="relative max-h-screen flex-col text-white object-fill w-full h-full hidden lg:flex"
            />
        </div>
    );
}
