import React from "react";
import { cn } from "@/lib/utils";

export default function NewBooks({ setIsOpenInfo, data, setSelectedBook }) {
    return (
        <div
            className={cn(
                "rounded-md border p-4",
                data.length > 0 ? "h-[512px]" : "h-full"
            )}
        >
            <h3 className="text-xl md:text-2xl font-semibold tracking-tight">
                Buku Terbaru
            </h3>
            <div className="space-y-4 my-4">
                {data.length > 0 ? (
                    data?.map((book) => (
                        <div
                            className="border-black border-2 p-5 rounded-lg"
                            key={book?.id}
                        >
                            <h4
                                className="text-primary text-lg md:text-xl font-semibold tracking-tight mb-2 truncate cursor-pointer"
                                onClick={() => {
                                    setIsOpenInfo(true);
                                    setSelectedBook(book);
                                }}
                            >
                                {book?.title}
                            </h4>
                            <p className="text-base md:text-lg">
                                Penulis : <b>{book?.writer}</b>
                            </p>
                            <p className="text-base md:text-lg">
                                Lokasi : <b>{book?.location}</b>
                            </p>
                        </div>
                    ))
                ) : (
                    <div className="flex justify-center items-center h-full">
                        <p className="text-primary text-lg md:text-xl font-semibold tracking-tight">
                            Belum ada buku yang ditambahkan.
                        </p>
                    </div>
                )}
            </div>
        </div>
    );
}
