import React from "react";

export default function NewBooks({
    setIsOpenInfo,
    data,
    setSelectedBook,
}) {
    return (
        <div className="h-[512px] rounded-md border p-4">
            <h3 className="text-2xl font-semibold tracking-tight">
                Buku Terbaru
            </h3>
            <div className="space-y-4 mt-4">
                {data?.map((book) => (
                    <div
                        className="border-black border-2 p-5 rounded-lg"
                        key={book?.id}
                    >
                        <h4
                            className="text-primary text-xl font-semibold tracking-tight mb-2 truncate cursor-pointer"
                            onClick={() => {
                                setIsOpenInfo(true);
                                setSelectedBook(book);
                            }}
                        >
                            {book?.title}
                        </h4>
                        <p className="text-lg">
                            Penulis : <b>{book?.writer}</b>
                        </p>
                        <p className="text-lg">
                            Lokasi : <b>{book?.location}</b>
                        </p>
                    </div>
                ))}
            </div>
        </div>
    );
}
